<?php


namespace App\Modules\Auth\Controllers;

use App\Common\Bases\Controller;
use App\Common\Exceptions\RepositoryException;
use App\Common\Tools\APIResponse;
use App\Modules\Auth\Exceptions\VerificationTokenException;
use App\Modules\Auth\Requests\VerifyRequest;
use App\Modules\Auth\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Auth
 */
class VerifyController extends Controller
{
    /**
     * @param VerifyRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws RepositoryException|VerificationTokenException
     */
    public function __invoke(VerifyRequest $request, UserService $userService): JsonResponse
    {
        $userService->verify($request);
        return APIResponse::successResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
