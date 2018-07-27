<?php
declare(strict_types=1);

namespace Api\Domain\Repository;

/**
 * Interface RepositoryInterface
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
interface RepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param string $httpQueryParams
     * @return mixed
     */
    public function findAll(string $httpQueryParams): array ;
}
