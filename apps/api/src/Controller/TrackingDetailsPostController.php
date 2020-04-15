<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Controller;

use Magento\CarrierMock\Application\TrackingDetailsGenerator;
use Magento\CarrierMock\Domain\MissingPackagesError;
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

        $this->ensurePackagesListIsPresent($payload);

        $packages = ($this->generator)($payload['params']['shipment']['packages']);

        $response->getBody()->write(json_encode($packages));

        return $response;
    }

    private function ensurePackagesListIsPresent(array $payload): void
    {
        if (
            empty($payload['params']) ||
            empty($payload['params']['shipment']) ||
            empty($payload['params']['shipment']['packages'])
        ) {
            throw MissingPackagesError::create();
        }
    }
}
