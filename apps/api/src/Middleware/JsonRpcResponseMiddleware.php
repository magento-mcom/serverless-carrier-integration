<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

final class JsonRpcResponseMiddleware
{
    private const JSON_RPC_VERSION = '2.0';

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);

        $responsePayload = json_decode((string)$response->getBody());

        $response = new SlimResponse();
        $response = $response->withHeader('Content-Type', 'application/json');

        $response->getBody()->write(
            json_encode(
                [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => 1,
                    'result' => $responsePayload,
                ]
            )
        );

        return $response;
    }
}
