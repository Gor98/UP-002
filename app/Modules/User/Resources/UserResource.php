<?php


namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Modules\Auth\Resources
 */
class UserResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'created_at' => format($this->created_at),
        ];
    }
}
