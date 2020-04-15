<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Domain;

use DomainException;

final class MissingPackagesError extends DomainException
{
    private const MESSAGE = 'Missing list of packages';

    public static function create(): MissingPackagesError
    {
        return new self(self::MESSAGE);
    }
}
