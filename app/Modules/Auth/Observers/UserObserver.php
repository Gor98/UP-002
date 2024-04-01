<?php

namespace App\Modules\Auth\Observers;

use App\Modules\Auth\Models\User;
use App\Modules\Auth\Notifications\RegisterNotification;

/**
 * Class UserObserver
 * @package App\Modules\Auth\Observers
 */
class UserObserver
{
    /**
     * @param User $user
     */
    public function creating(User $user): void
    {
        if (is_null($user->oauth_id)) {
            $user->verification_token = makeToken();
            $user->verification_token_expires_at = now()->addHour();
        }
    }

    /**
     * @param User $user
     */
    public function created(User $user): void
    {
        if (is_null($user->oauth_id)) {
            $user->notify(new RegisterNotification($user->verification_token, $user->email));
        }
    }
}
