<?php
declare(strict_types=1);

namespace Api\Domain\Service;
use Api\Domain\Repository\GithubRepository;

/**
 * Class GithubService
 * This class implemented as Github search provider.
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
class GithubService implements ProviderInterface
{
    /**
     * Provider's API endpoint URI
     */
    const URI = "https://api.github.com/search/code";

    /**
     * @var GithubRepository
     */
    private $repository;

    /**
     * GithubService constructor.
     * @param GithubRepository $githubRepository
     */
    public function __construct(GithubRepository $githubRepository)
    {
        $this->repository = $githubRepository;
    }

    /**
     * @return array
     */
    public function getQueryStringMapperArray(): array
    {
        return [
            'q' => 'q',
            'page_count' => 'per_page',
            'page' => 'page',
            'sort' => 'sort',
            'order' => 'order'
        ];
    }

    /**
     * This function searches in the provider's API using given query
     *
     * @param string $httpQueryParams
     * @return array
     */
    public function search(string $httpQueryParams): array
    {
        return $this->repository->findAll($httpQueryParams);
    }
}
