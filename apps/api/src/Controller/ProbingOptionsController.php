<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ProbingOptionsController
{
    public function __invoke(Request $request, Response $response): Response
    {
        return $response->withHeader('X-Magento-Service-Bus', '*');
    }
}
