<?php
declare(strict_types=1);

namespace App\Repository\Dto;

use App\Repository\AbstractRepository;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Class UserDto
 * @package App\Repository\Dto
 */
final class UserDto extends AbstractDto
{
    /**
     * @param AbstractRepository $abstractRepository
     * @return AbstractDto
     * @throws Exception
     */
    public function storeDto(AbstractRepository $abstractRepository): AbstractDto
    {
        $this->setDataByKey('confirm_key', Uuid::uuid4()->toString());
        $this->setDataByKey('password', bcrypt($this->getDataByKey('password')));

        return parent::storeDto($abstractRepository);
    }
}
