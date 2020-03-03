<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProjectRepository
 * @package App\Repository
 */
final class ProjectRepository extends AbstractRepository
{
    /**
     * ProjectRepository constructor.
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }


    /**
     * @param array $data
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function all(array $data = [])
    {
        $this->getQuery()->with('user')->latest();

        return parent::all($data);
    }
}
