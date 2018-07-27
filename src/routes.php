<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Api\Domain\Service\RequestProcessor;
use Api\Domain\Service\ParamsValidatorService;
use Api\Domain\Service\GithubService;
use Api\Domain\Repository\GithubRepository;

// Restful Api routes
$app->group('/api', function () use ($app) {

    // Get all repositories
    $app->get('/repositories', function (Request $request, Response $response) use ($app) {

        $paramsValidator = new ParamsValidatorService($request->getQueryParams());

        $providerAdapters = [
            'githubService' => new GithubService(new GithubRepository())
        ];

        $requestProcessor = new RequestProcessor($response, $paramsValidator, $providerAdapters);

        return $requestProcessor->process();
    });
});
