<?php
declare(strict_types=1);

namespace App\Http\Resources\Subject;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SubjectResource
 * @package App\Http\Resources\Role
 */
class SubjectResource extends JsonResource
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
            'id'    => $this->id,
            'name'  => $this->$locale,
            'price' => $this->price,
        ];
    }
}
