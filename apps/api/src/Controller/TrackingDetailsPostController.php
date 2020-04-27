<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Controller;

use Magento\CarrierMock\Application\TrackingDetailsGenerator;
use Magento\CarrierMock\Domain\MissingPackagesList;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class TrackingDetailsPostController
{
    private TrackingDetailsGenerator $generator;

    public function __construct(TrackingDetailsGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $payload = $request->getParsedBody();

        $this->ensurePayloadContainsThePackagesList($payload);

        $packages = ($this->generator)($payload['params']['shipment']['packages']);

        $content = [
            'jsonrpc' => '2.0',
            'id' => 1,
            'result' => $packages,
        ];

        $response->getBody()->write(json_encode($content));

        return $response;
    }

    private function ensurePayloadContainsThePackagesList(array $payload): void
    {
        if (
            empty($payload['params']) ||
            empty($payload['params']['shipment']) ||
            empty($payload['params']['shipment']['packages'])
        ) {
            throw MissingPackagesList::create();
        }
    }
}
