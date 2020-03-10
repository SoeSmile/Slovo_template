<?php
declare(strict_types=1);

namespace App\Http\Resources\Journal;

use App\Http\Resources\User\UserMiniResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class JournalResource
 * @package App\Http\Resources\Journal
 */
class JournalResource extends JsonResource
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
            'user'      => new UserMiniResource($this->user),
            'event'     => trans('events.'.$this->event),
            'data'      => $this->data,
            'createdAt' => $this->created_at,
        ];
    }
}
