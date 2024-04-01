<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Modules\Auth\Models
 */
class User extends Model
{
    use  HasFactory, Notifiable;


}
