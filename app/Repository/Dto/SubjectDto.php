<?php
declare(strict_types=1);

namespace App\Repository\Dto;

use App\Repository\AbstractRepository;

/**
 * Class SubjectDto
 * @package App\Repository\Dto
 */
final class SubjectDto extends AbstractDto
{
    /**
     * @param AbstractRepository $abstractRepository
     * @return AbstractDto
     */
    public function storeDto(AbstractRepository $abstractRepository): AbstractDto
    {
        $this->setDataByKey(app()->getLocale(), $this->getDataByKey('name'));

        return parent::storeDto($abstractRepository);
    }


    /**
     * @param AbstractRepository $abstractRepository
     * @return AbstractDto
     */
    public function updateDto(AbstractRepository $abstractRepository): AbstractDto
    {
        $this->setDataByKey(app()->getLocale(), $this->getDataByKey('name'));

        return parent::updateDto($abstractRepository);
    }
}
