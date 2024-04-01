<?php


namespace App\Modules\Auth\Requests;

use App\Common\Bases\BaseRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 */
class LoginRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required_without:code,target|email|exists:users',
            'password' => 'required_without:code,target|string',

            'code' => 'required_without:email,password|string',
            'target' => 'required_without:email,password|string|in:google,facebook',
        ];
    }

}
