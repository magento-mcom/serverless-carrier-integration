<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Application;

final class TrackingDetailsGenerator
{
    private const CARRIER = 'carrier_mock';

    public function __invoke(array $packages): array
    {
        $updated = [];

        foreach ($packages as $package) {
            $package['carrier'] = self::CARRIER;
            $updated[] = $package;
        }

        return $updated;
    }
}
