<?php
declare(strict_types=1);

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleResource
 * @package App\Http\Resources\Role
 */
class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $locale = app()->getLocale();

        return [
            'id'   => $this->id,
            'type' => $this->type,
            'name' => $this->$locale
        ];
    }
}
