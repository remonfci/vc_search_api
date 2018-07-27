<?php
declare(strict_types=1);

namespace Api\Domain\Service;

/**
 * Interface ProviderInterface
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
interface ProviderInterface
{
    public function getQueryStringMapperArray(): array ;

    public function search(string $httpQueryParams): array ;
}
