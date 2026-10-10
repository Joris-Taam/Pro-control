<?php

namespace ProControl\Backend\Util;

use InvalidArgumentException;

final class DeviceTable
{
    private const TABLES = [
        'cabinet_devices' => 'cabinet_devices',
        'field_devices' => 'field_devices',
    ];

    public static function fromInput(string $table): string
    {
        if (!isset(self::TABLES[$table])) {
            throw new InvalidArgumentException('The selected device table is invalid.');
        }

        return self::TABLES[$table];
    }
}
