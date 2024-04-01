<?php


namespace App\Modules\Auth\Controllers;

use App\Common\Bases\Controller;
use App\Common\Exceptions\RepositoryException;
use App\Common\Tools\APIResponse;
use App\Modules\Auth\Requests\ResetPasswordRequest;
use App\Modules\Auth\Requests\SetPasswordRequest;
use App\Modules\Auth\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PasswordController
 * @package App\Http\Controllers\Api\Auth
 */
class PasswordController extends Controller
{
    /**
     * @param ResetPasswordRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function reset(ResetPasswordRequest $request, UserService $userService): JsonResponse
    {
        $userService->resetPassword($request);
        return APIResponse::successResponse([], '', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param SetPasswordRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function set(SetPasswordRequest $request, UserService $userService): JsonResponse
    {
        $userService->setPassword($request);
        return APIResponse::successResponse([], '', Response::HTTP_NO_CONTENT);
    }

}
