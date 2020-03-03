<?php
declare(strict_types=1);

namespace App\Repository\Dto;

use App\Repository\AbstractRepository;

/**
 * Class AbstractSerialize
 * @package App\Repository\Serialize
 */
abstract class AbstractDto
{
    /**
     * @var array
     */
    private array $data;


    /**
     * AbstractSerialize constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = snakeKeys($data);
    }


    /**
     * @param AbstractRepository $abstractRepository
     * @return $this
     */
    public function storeDto(AbstractRepository $abstractRepository): self
    {
        $this->setData($this->getDiffData($abstractRepository));

        return $this;
    }


    /**
     * @param AbstractRepository $abstractRepository
     * @return $this
     */
    public function updateDto(AbstractRepository $abstractRepository): self
    {
        $this->setData($this->getDiffData($abstractRepository));

        return $this;
    }


    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param string $key
     * @return mixed|null
     */
    public function getDataByKey(string $key)
    {
        return $this->data[$key] ?? null;
    }


    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }


    /**
     * @param string $key
     * @param $value
     */
    public function setDataByKey(string $key, $value): void
    {
        $this->data[$key] = $value;
    }


    /**
     * get table fields
     *
     * @param AbstractRepository $abstractRepository
     * @return array
     */
    public function getFields(AbstractRepository $abstractRepository): array
    {
        $table = $abstractRepository->getModel()->getTable();

        return \array_flip(\Schema::getColumnListing($table));
    }


    /**
     * get strong data
     *
     * @param AbstractRepository $abstractRepository
     * @return array
     */
    public function getDiffData(AbstractRepository $abstractRepository): array
    {
        return \array_intersect_key($this->getData(), $this->getFields($abstractRepository));
    }
}
