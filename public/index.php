<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->options('/api', function (Request $request, Response $response, $args) {
    $response = $response->withHeader('X-Magento-Service-Bus', '*');
    return $response;
});

$app->post('/api', function (Request $request, Response $response, $args) {
    $data = [
        'jsonrpc' => 2.0,
        'id' => 1,
        'result' => [
            [
                'id' => 'PACKAGE',
                'tracking_number' => '123456',
                'tracking_link' => 'http://mocking.test/carrier',
                'tracking_number' => '123456',
            ],
        ],
    ];

    $payload = json_encode($data);

    $response->getBody()->write($payload);

    return $response;
});

$app->run();
