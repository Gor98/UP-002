<?php


namespace App\Modules\Auth\Controllers;

use App\Common\Bases\Controller;
use App\Common\Exceptions\RepositoryException;
use App\Common\Tools\APIResponse;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Resources\UserResource;
use App\Modules\Auth\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


/**
 * Class RegisterController
 * @package App\Modules\Auth\Controllers
 */
class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws RepositoryException|ValidationException
     */
    public function __invoke(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        return APIResponse::successResponse(new UserResource($authService->register($request)));
    }
}
