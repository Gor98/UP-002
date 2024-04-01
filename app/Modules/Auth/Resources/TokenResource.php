<?php


namespace App\Modules\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TokenResource
 * @package App\Modules\Auth\TokenResource
 */
class TokenResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'access_token' => $this['token'],
            'token_type' => "Bearer",
            'expires_in' => format(now()->addSeconds($this['expires_in']))
        ];
    }
}
