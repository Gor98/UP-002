<?php


namespace App\Modules\Auth\Services;


use App\Common\Bases\Service;
use App\Common\Exceptions\RepositoryException;
use App\Modules\Auth\Exceptions\VerificationTokenException;
use App\Modules\Auth\Notifications\RegisterNotification;
use App\Modules\Auth\Notifications\ResetPasswordNotification;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Auth\Requests\ResetPasswordRequest;
use App\Modules\Auth\Requests\SetPasswordRequest;
use App\Modules\Auth\Requests\VerifyRequest;

/**
 * Class SleepService
 * @package App\Modules\Auth\Services
 */
class UserService extends Service
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * SleepService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param VerifyRequest $request
     * @throws RepositoryException
     * @throws VerificationTokenException
     */
    public function verify(VerifyRequest $request): void
    {
        $user = $this->userRepository->findBy(['verification_token' => $request->input('token')]);

        if ($user->verification_token_expires_at < now()) {
            $this->userRepository->update(
                ['verification_token_expires_at' => now()->addHour(), 'verification_token' => makeToken()],
                $user
            );
            $user->notify(new RegisterNotification($user->verification_token, $user->email));
            throw new VerificationTokenException();
        }
        $this->userRepository->update(
            [
                'verification_token' => null,
                'verification_token_expires_at' => null,
                'email_verified_at' => now()
            ],
            $user
        );
    }

    /**
     * @param ResetPasswordRequest $request
     * @throws RepositoryException
     */
    public function resetPassword(ResetPasswordRequest $request): void
    {
        $user = $this->userRepository->findBy(['email' => $request->input('email')]);
        $this->userRepository->update(['reset_token' => makeToken()], $user);
        $user->notify(new ResetPasswordNotification($user->reset_token, $user->email));
    }

    /**
     * @param SetPasswordRequest $request
     * @throws RepositoryException
     */
    public function setPassword(SetPasswordRequest $request): void
    {
        $this->userRepository->update(
            ['password' => $request->input('password'), 'reset_token' => null],
            ['email' => $request->input('email'), 'reset_token' => $request->input('reset_token')]
        );
    }
}
