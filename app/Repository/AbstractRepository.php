<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\Traits\Filter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
abstract class AbstractRepository
{
    use Filter;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Builder
     */
    protected Builder $query;


    /**
     * AbstractRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $model::query();
    }


    /**
     * @return $this
     */
    public function getQuery(): self
    {
        $this->query = $this->model::query();

        return $this;
    }


    /**
     * @param array $data
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function all(array $data = [])
    {
        if (isset($data['count'])) {

            return $this->query->paginate($data['count'] ?? 25);
        }

        return $this->query->get();
    }


    /**
     * @param mixed $id
     * @return Builder|Model|object|null
     */
    public function get($id)
    {
        return $this->query->where('id', $id)->first();
    }


    /**
     * @param array $data
     * @return Builder|Model
     */
    public function store(array $data)
    {
        return $this->query->create($data);
    }


    /**
     * @param $id
     * @param array $data
     * @return int
     */
    public function update($id, array $data): int
    {
        return $this->query->where('id', $id)->update($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->query->where('id', $id)->delete();
    }
}