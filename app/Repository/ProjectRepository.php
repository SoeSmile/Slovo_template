<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
        // Фильтр по пользователю
        $this->filter('user_id', $data['user'] ?? auth()->id());

        return parent::all($data);
    }


    /**
     * @param array $data
     * @return Builder|Model
     */
    public function store(array $data)
    {
        $data['user_id'] = auth()->id();

        return parent::store($data);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function delete(array $data)
    {
        return $this->query->whereIn('id', $data)->delete();
    }
}