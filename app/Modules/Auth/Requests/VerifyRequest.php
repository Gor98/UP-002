<?php


namespace App\Modules\Auth\Requests;

use App\Common\Bases\BaseRequest;

/**
 * Class VerifyRequest
 * @package App\Modules\Auth\Requests
 */
class VerifyRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'token' => 'required|string|exists:users,verification_token',
        ];
    }

}
