<?php
declare(strict_types=1);

namespace Api\Domain\Service;

use Slim\Http\Response;

/**
 * Class RequestProcessor
 * This Service is used to process requests.
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
class RequestProcessor
{
    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @var ParamsValidatorInterface $paramsValidator
     */
    protected $paramsValidator;

    /**
     * @var array $providerAdapters
     */
    protected $providerAdapters;

    /**
     * Constructor
     *
     * @param Response $response
     * @param ParamsValidatorInterface $paramsValidator
     * @param array $providerAdapters
     */
    public function __construct(
        Response $response,
        ParamsValidatorInterface $paramsValidator,
        array $providerAdapters
    ) {
        $this->response = $response;
        $this->paramsValidator = $paramsValidator;
        $this->providerAdapters = $providerAdapters;
    }

    /**
     * process Api request, validating query params then process requests.
     *
     * @return Response
     */
    public function process(): Response
    {
        $totalSearchResults = [];

        foreach ($this->providerAdapters as $key => $providerAdapter) {
            $validatedParams =
                $this->paramsValidator->validate($providerAdapter
                    ->getQueryStringMapperArray());

            if ($validatedParams['error_count'] > 0) {
                return $this->response->withStatus(406)
                    ->withHeader('Content-Type', 'application/json')
                    ->write(json_encode($validatedParams['errors']));
            }

            $providerSearchResult = $providerAdapter->search(http_build_query($validatedParams));

            foreach ($providerSearchResult as $providerResultItem) {
                array_push($totalSearchResults, $providerResultItem);
            }
        }


        if (count($totalSearchResults) > 0) {
            return $this->response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($totalSearchResults));
        } else {
            return $this->response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(["Error" => "No data found!"]));
        }
    }
}
