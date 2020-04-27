<?php

declare(strict_types=1);

use Magento\CarrierMock\Controller\ProbingOptionsController;
use Magento\CarrierMock\Controller\TrackingDetailsPostController;

$app->options('/api', ProbingOptionsController::class);
$app->post('/api', TrackingDetailsPostController::class);
