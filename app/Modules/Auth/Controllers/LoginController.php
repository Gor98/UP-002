<?php


namespace App\Modules\Auth\Controllers;

use App\Common\Bases\Controller;
use App\Common\Exceptions\RepositoryException;
use App\Common\Tools\APIResponse;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Resources\TokenResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class LoginController
 * @package App\Modules\Auth\Controllers
 */
class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws AuthenticationException
     * @throws RepositoryException
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        return APIResponse::successResponse(new TokenResource($authService->login($request)));
    }

    /**
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function logout(AuthService $authService): JsonResponse
    {
        $authService->logout();
        return APIResponse::successResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
