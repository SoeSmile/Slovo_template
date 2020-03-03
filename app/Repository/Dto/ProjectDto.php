<?php
declare(strict_types=1);

namespace App\Repository\Dto;

use App\Repository\AbstractRepository;

/**
 * Class ProjectDto
 * @package App\Repository\Serialize
 */
final class ProjectDto extends AbstractDto
{
    /**
     * @param AbstractRepository $abstractRepository
     * @return AbstractDto
     */
    public function storeDto(AbstractRepository $abstractRepository): AbstractDto
    {
        $this->setDataByKey('user_id', auth()->id());

        return parent::storeDto($abstractRepository);
    }
}
