<?php

declare(strict_types=1);

namespace Magento\CarrierMock\Domain;

use DomainException;

final class MissingPackagesList extends DomainException
{
    private const MESSAGE = 'Missing list of packages';

    public static function create(): MissingPackagesList
    {
        return new self(self::MESSAGE);
    }
}
