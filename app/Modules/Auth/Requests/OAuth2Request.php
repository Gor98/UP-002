<?php


namespace App\Modules\Auth\Requests;

use App\Common\Bases\BaseRequest;
use App\Common\Constants\CommonDeviceConstant;


/**
 * Class AuthRequest
 * @package App\Modules\Auth\Requests
 */
class OAuth2Request extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'device_type' => 'required|string|in:' . $this->implode(',', CommonDeviceConstant::DEVICES)
        ];
    }
}
