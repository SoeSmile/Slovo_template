<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\Dto\AbstractDto;
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
    /**
     * @var Model
     */
    private Model $model;

    /**
     * @var Builder
     */
    private Builder $query;


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
     * @param array $data
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function all(array $data = [])
    {
        if (isset($data['count']) && $data['count'] > 0) {
            return $this->query->paginate(\is_numeric($data['count']) ? $data['count'] : 20);
        }

        return $this->query->get();
    }


    /**
     * @param mixed $id
     * @return Builder|Model|object|null
     */
    public function get($id)
    {
        return $this->query->where('id', $id)->firstOrFail();
    }


    /**
     * @param AbstractDto $dto
     * @return Builder|Model
     */
    public function store(AbstractDto $dto)
    {
        return $this->query->create($dto->storeDto($this)->getData());
    }


    /**
     * @param $id
     * @param AbstractDto $dto
     * @return int
     */
    public function update($id, AbstractDto $dto): int
    {
        return $this->query->where('id', $id)->update($dto->updateDto($this)->getData());
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->query->where('id', $id)->delete();
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function destroyMass(array $data)
    {
        return $this->query->whereIn('id', $data)->delete();
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }


    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->query;
    }


    /**
     * @return $this
     */
    public function newQuery(): self
    {
        $this->query = $this->model::query();

        return $this;
    }
}
