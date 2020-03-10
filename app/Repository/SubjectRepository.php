<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Subjects;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SubjectRepository
 * @package App\Repository
 */
final class SubjectRepository extends AbstractRepository
{
    /**
     * SubjectRepository constructor.
     * @param Subjects $model
     */
    public function __construct(Subjects $model)
    {
        parent::__construct($model);
    }


    /**
     * @param array $data
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function all(array $data = [])
    {
        // фильтр по локализации
        if (isset($data['name'])) {
            $this->getQuery()->where(app()->getLocale(), 'ilike', $data['name'] . '%');
        }

        return parent::all($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO удаление только если нет в заказах
        return parent::destroy($id);
    }
}
