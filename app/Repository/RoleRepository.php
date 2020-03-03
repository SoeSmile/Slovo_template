<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Role;

/**
 * Class RoleRepository
 * @package App\Repository
 */
final class RoleRepository extends AbstractRepository
{
    /**
     * RoleRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
