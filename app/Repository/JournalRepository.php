<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Journal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class JournalRepository
 * @package App\Repository
 */
final class JournalRepository extends AbstractRepository
{
    /**
     * @var Journal
     */
    private Journal $journal;


    /**
     * JournalRepository constructor.
     * @param Journal $model
     */
    public function __construct(Journal $model)
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

        // фильтр по событию
        if (isset($data['event'])) {
            $this->getQuery()->where('event', $data['event']);
        }

        // фильтр по пользователю
        if (isset($data['user'])) {
            $this->getQuery()->whereHas('user', fn($q) => $q->where('name', 'ilike', $data['user'] . '%'));
        }

        // фильтр по дате
        if (isset($data['dateRange'])) {
            $this->getQuery()
                ->whereDate('created_at', '>=', $data['dateRange'][0])
                ->whereDate('created_at', '<=', $data['dateRange'][1]);
        }

        return parent::all($data);
    }
}
