<?php
declare(strict_types=1);

namespace Api\Domain\Repository;

use Api\Domain\Entity\File;

/**
 * Class GithubRepository
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
class GithubRepository extends Repository implements RepositoryInterface
{
    /**
     * Provider's API endpoint URI
     */
    const URI = "https://api.github.com/search/code";

    /**
     * @param int $id
     * @return mixed|void
     */
    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @param string $httpQueryParams
     * @return array|mixed
     */
    public function findAll(string $httpQueryParams): array
    {
        $files = [];

        $githubResponse = \Requests::get(self::URI . '?' .$httpQueryParams);
        $response = json_decode($githubResponse->body, true);

        foreach ($response['items'] as $key => $item) {
            $row = [
                'ownerName' => $item['repository']['owner']['login'],
                'repositoryName' => $item['repository']['name'],
                'name' => $item['name']
            ];

            $files[] = $this->createInstance($row, File::class);
        }

        return $files;
    }
}
