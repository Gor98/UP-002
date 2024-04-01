<?php


namespace App\Modules\Auth\Requests;

use App\Common\Bases\BaseRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 */
class ResetPasswordRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users'
        ];
    }

}
