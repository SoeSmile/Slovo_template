<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 * @package App\Repository
 */
final class UserRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    /**
     * @param array $data
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function all(array $data = [])
    {
        $this->getQuery()->withCount('projects')->latest();

        // если админ вывод последней даты входа
        if (isAdmin()) {
            $this->getQuery()->with('journalsLastLogin');
        }

        return parent::all($data);
    }


    /**
     * get user by ConfirmKey
     *
     * @param string $key
     * @return Builder|Model|object|null
     */
    public function getByConfirmKey(string $key)
    {
        return $this->getQuery()->where('confirm_key', $key)->first();
    }


    /**
     * approve users
     *
     * @param array $ids
     * @return bool
     */
    public function approve(array $ids): bool
    {
        $users = $this->getQuery()->whereIn('id', $ids)->get();

        foreach ($users as $user) {
            $user->update(['confirm' => !$user->confirm]);
        }

        return true;
    }
}
