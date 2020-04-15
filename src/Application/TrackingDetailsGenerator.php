<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Application;

final class TrackingDetailsGenerator
{
    private const CARRIER = 'carrier_mock';
    private const LINK = 'https://www.sci.test/?trackingNumber=%s';

    public function __invoke(array $packages): array
    {
        $updated = [];

        foreach ($packages as $package) {
            $trackingNumber = $this->randomTrackingNumber();

            $package['carrier'] = self::CARRIER;
            $package['tracking_number'] = $trackingNumber;
            $package['tracking_link'] = sprintf(self::LINK, $trackingNumber);

            $updated[] = $package;
        }

        return $updated;
    }

    private function randomTrackingNumber(): int
    {
        return random_int(0, 10 ** 6);
    }
}
