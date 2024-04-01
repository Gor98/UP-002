<?php


namespace App\Modules\User\Controllers;

use App\Common\Bases\Controller;
use App\Common\Exceptions\RepositoryException;
use App\Common\Tools\APIResponse;
use App\Modules\User\Requests\UpdateProfileRequest;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Auth
 */
class ProfileController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function update(UpdateProfileRequest $request)
    {
        return APIResponse::successResponse(new UserResource($this->userService->updateProfile($request)));
    }

    /**
     * @return JsonResponse
     */
    public function profile()
    {
        return APIResponse::successResponse(new UserResource(auth()->user()));
    }

    /**
     * @return JsonResponse
     */
    public function testVerify()
    {
        return APIResponse::successResponse('only verified user can see this');
    }
}
