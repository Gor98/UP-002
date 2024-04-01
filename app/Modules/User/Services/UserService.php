<?php


namespace App\Modules\User\Services;


use App\Common\Bases\Service;
use App\Common\Exceptions\RepositoryException;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\User\Requests\UpdateProfileRequest;
use Illuminate\Database\Eloquent\Model;

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
     * @param UpdateProfileRequest $request
     * @return Model
     * @throws RepositoryException
     */
    public function updateProfile(UpdateProfileRequest $request): Model
    {
        return $this->userRepository->update($request->all(), $request->user());
    }
}
