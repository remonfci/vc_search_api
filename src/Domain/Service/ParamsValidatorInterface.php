<?php
declare(strict_types=1);

namespace Api\Domain\Service;

/**
 * Interface ParamsValidatorInterface
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
interface ParamsValidatorInterface
{
    public function validate(array $queryStringMapperArray): array ;
}
