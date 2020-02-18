<?php
declare(strict_types=1);

namespace App\Http\Resources\Project;

use App\Http\Resources\User\UserMiniResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'user'      => new UserMiniResource($this->user),
            'note'      => $this->note,
            'url'       => $this->url,
            'data'      => $this->data,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
