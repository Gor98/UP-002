<?php

namespace App\Modules\Auth\Services;

use App\Common\Bases\Service;
use App\Common\Exceptions\RepositoryException;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\OAuth2Request;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Modules\Auth\Requests\TokenRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthServiceService
 * @package App\Modules\Auth\Services
 */
class AuthService extends Service
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * AuthService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     * @return Model|mixed
     * @throws RepositoryException
     * @throws ValidationException
     */
    public function register(RegisterRequest $request)
    {
        if ($request->input('code') && $request->input('target')) {
            $userInfo = $this->oauthInfo($request->only(['code', 'target']));
            if ($this->userRepository->existBy(['email' => $userInfo['email']])) {
                throw ValidationException::withMessages(['email' => 'The email has already been taken.']);
            }
            $data = array_merge(
                $userInfo,
                ['oauth_type' => $request->input('target'), 'email_verified_at' => now()]
            );
        }

        return $this->userRepository->create($data ?? $request->all());
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return array
     * @throws AuthenticationException|RepositoryException
     */
    public function login(LoginRequest $request): array
    {
        if ($request->input('code') && $request->input('target')) {
            $userInfo = $this->oauthInfo($request->only(['code', 'target']));
            $user = $this->userRepository->findBy(['email' => $userInfo['email']]);
            if (is_null($user)) {
                $user = $this->userRepository->create(
                    array_merge($userInfo, ['oauth_type' => $request->input('target')])
                );
            }
            $token = auth('api')->login($user);
        } else if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            throw new AuthenticationException();
        }

        return [
            'token' => $token,
            "expires_in" => auth()->factory()->getTTL() * 60
        ];
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout(): void
    {
        auth()->logout();
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function oauthInfo(array $data): array
    {
        $driver = app($data['target']);
        $config = config($data['target']);
        $credentials = $driver->token($config, urldecode($data['code']));

        return $driver->details($config, $credentials['access_token']);
    }

    /**
     * @param OAuth2Request $request
     * @return array
     */
    public function getOauthUrl(OAuth2Request $request): array
    {
        $authProvider = app($request->input('device_type'));
        $oauthData = config($request->input('device_type'));

        return ['url' => $authProvider->oauth2Url($oauthData)];
    }

    /**
     * @param TokenRequest $request
     * @return array
     */
    public function getOauthToken(TokenRequest $request): array
    {
        $authProvider = app($request->input('device_type'));
        $oauth2Data = config($request->input('device_type'));

        return $authProvider->token($oauth2Data, $request->input('code'));
    }
}
