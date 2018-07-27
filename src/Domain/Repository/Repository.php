<?php
declare(strict_types=1);

namespace Api\Domain\Repository;


use Api\Domain\Entity\Entity;

/**
 * Class Repository
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
abstract class Repository
{
    /**
     * @param string $entity
     * @param array $row
     * @return Entity
     */
    protected function createInstance(array $row, $entity): Entity
    {
        try {
            return $this->map($row, new $entity());
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $row
     * @param Entity $entity
     * @return Entity
     * @throws \Exception
     */
    protected function map($row, Entity $entity): Entity
    {
        foreach ($row as $attribute => $value) {
            $method = 'set' . ucfirst($attribute);
            if (method_exists($entity, $method)) {
                call_user_func_array(array($entity, $method), array($value));
            } else {
                throw new \Exception("No setter method exists for '$attribute'");
            }
        }
        return $entity;
    }
}
