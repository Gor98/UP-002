<?php


namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 */
class SetPasswordRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'reset_token' => 'required|string|exists:users,reset_token',
            'password' => 'required|confirmed|min:8|max:64',
        ];
    }

}
