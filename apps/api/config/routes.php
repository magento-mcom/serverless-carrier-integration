<?php

declare(strict_types=1);

use Magento\CarrierMock\Controller\ProbingOptionsController;
use Magento\CarrierMock\Controller\TrackingDetailsPostController;
use Magento\CarrierMock\Middleware\JsonRpcResponseMiddleware;
use Magento\CarrierMock\Middleware\JsonRpcRequestParamsExtractorMiddleware;

//$app->add(JsonRpcRequestParamsExtractorMiddleware::class);
$app->add(JsonRpcResponseMiddleware::class);

$app->get('/api', ProbingOptionsController::class);
$app->post('/api', TrackingDetailsPostController::class);
