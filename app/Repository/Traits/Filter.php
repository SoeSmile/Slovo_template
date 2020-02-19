<?php
declare(strict_types=1);

namespace App\Repository\Traits;

use Illuminate\Database\Query\Builder;

/**
 * Trait Filter
 * @package App\Repository\Traits
 */
trait Filter
{
    /**
     * @param string $name
     * @param $val
     * @param string $condition
     * @return void
     */
    public function filter(string $name, $val, string $condition = '='): void
    {
        $this->query->where($name, $condition, $val);
    }
}
