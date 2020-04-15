<?php

declare(strict_types=1);

use DI\Container;
use Magento\CarrierMock\Application\TrackingDetailsGenerator;
use Magento\CarrierMock\Controller\ProbingOptionsController;
use Magento\CarrierMock\Controller\TrackingDetailsPostController;

$container = new Container();

$container->set(
    'probing_options_controller',
    static function () {
        return new ProbingOptionsController();
    }
);

$container->set(
    'tracking_details_post_controller',
    static function () use ($container) {
        return new TrackingDetailsPostController($container->get('tracking_details_generator'));
    }
);

$container->set(
    'tracking_details_generator',
    static function () {
        return new TrackingDetailsGenerator();
    }
);

return $container;

