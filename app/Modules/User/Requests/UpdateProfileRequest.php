<?php


namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 */
class UpdateProfileRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'first_name' => "sometimes|string|max:255",
            'last_name' => "sometimes|string|max:255",
            'email' => "sometimes|email|unique:users|max:255",
            'password' => "sometimes|string|confirmed|min:8|max:64",
        ];
    }

}
