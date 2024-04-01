<?php


namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 */
class RegisterRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'code' => 'required_without:first_name,last_name,email,password|string',
            'target' => 'required_without:first_name,last_name,email,password|string|in:google,facebook',

            'first_name' => "required_without:code,target|string|max:255",
            'last_name' => "required_without:code,target|string|max:255",
            'email' => "required_without:code,target|email|unique:users|max:255",
            'password' => "required_without:code,target|string|confirmed|min:8|max:64",
        ];
    }

}
