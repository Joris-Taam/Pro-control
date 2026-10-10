<?php

use ProControl\Backend\Service\DeviceService;

require_once dirname(__DIR__, 2) . '/backend/bootstrap.php';

final class PageController
{
    private static ?DeviceService $devices = null;
    private static ?string $currentDeviceTable = null;

    private const VIEWS = [
        'home' => 'index.php',
        'add' => 'add.php',
        'archive' => 'archive.php',
        'archive-detail' => 'archive-device.php',
        'archive-cabinet' => 'archive-device.php',
        'archive-field' => 'archive-device.php',
        'edit' => 'Edit.php',
        'edit-cabinet' => 'edit-device.php',
        'edit-field' => 'edit-device.php',
    ];

    public static function render(string $page): void
    {
        if (!isset(self::VIEWS[$page])) {
            http_response_code(404);
            echo 'Page not found.';
            return;
        }

        if (!defined('APP_ROOT')) {
            define('APP_ROOT', dirname(__DIR__, 2));
        }

        $deviceTables = [
            'edit-cabinet' => 'cabinet_devices',
            'edit-field' => 'field_devices',
            'archive-detail' => 'cabinet_devices',
            'archive-cabinet' => 'cabinet_devices',
            'archive-field' => 'field_devices',
        ];
        $deviceTable = $deviceTables[$page] ?? null;
        self::$currentDeviceTable = $deviceTable;

        require_once APP_ROOT . '/frontend/Components/navigation.php';
        require_once APP_ROOT . '/frontend/Components/footer.php';
        require APP_ROOT . '/frontend/views/' . self::VIEWS[$page];
    }

    public static function deviceTable(): string
    {
        if (self::$currentDeviceTable === null) {
            throw new \LogicException('A device page must be rendered before accessing its table.');
        }

        return self::$currentDeviceTable;
    }

    public static function listDevices(string $table, bool $archived, string $orderBy, string $direction): array
    {
        return self::service()->listDevices($table, $archived, $orderBy, $direction);
    }

    public static function findDevice(string $table, int $id): ?array
    {
        return self::service()->findById($table, $id);
    }

    public static function updateDevice(string $table, int $id, array $formData): void
    {
        self::service()->updateFromForm($table, $id, $formData);
    }

    public static function setDeviceArchived(string $table, int $id, bool $archived): void
    {
        self::service()->setArchived($table, $id, $archived);
    }

    private static function service(): DeviceService
    {
        if (self::$devices === null) {
            self::$devices = new DeviceService();
        }

        return self::$devices;
    }
}
