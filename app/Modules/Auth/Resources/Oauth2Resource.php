<?php


namespace App\Modules\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Oauth2Resource
 * @package App\Modules\Auth\Resources
 */
class Oauth2Resource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'url' => $this['url'],
        ];
    }
}
