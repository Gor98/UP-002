<?php


namespace App\Modules\User\Repositories;

use App\Common\Bases\Repository;
use App\Modules\Auth\Models\User;

/**
 * Class UserRepository
 * @package App\Modules\Auth\Repositories
 */
class UserRepository extends Repository
{
    /**
     * @var array
     */
    protected array $fillable = [
        'first_name',
        'last_name',
        'oauth_type',
        'oauth_id',
        'reset_token',
        'password',
        'email',
        'verification_token',
        'email_verified_at',
        'verification_token_expires_at',
    ];

    /**
     * @return string
     */
    protected function model(): string
    {
        return User::class;
    }
}
