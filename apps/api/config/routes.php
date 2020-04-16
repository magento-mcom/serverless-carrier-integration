<?php

declare(strict_types=1);

use Magento\CarrierMock\Controller\ProbingOptionsController;
use Magento\CarrierMock\Controller\TrackingDetailsPostController;
use Magento\CarrierMock\Middleware\JsonRpcResponseMiddleware;
use Magento\CarrierMock\Middleware\JsonRpcRequestParamsExtractorMiddleware;

$app->add(JsonRpcResponseMiddleware::class);

$app->options('/api', ProbingOptionsController::class);
$app->post('/api', TrackingDetailsPostController::class);
