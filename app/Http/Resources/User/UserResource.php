<?php
declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources\User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'login'    => $this->login,
            'email'    => $this->email,
            'timeZone' => $this->time_zone,
            'role'     => new RoleResource($this->role),
            'note'     => $this->note,
        ];
    }
}
