<?php

namespace ProControl\Backend\Util;

use PDO;
use RuntimeException;

final class Database
{
    public static function connect(): PDO
    {
        self::loadEnvironment();

        $server = getenv('PROCONTROL_DB_SERVER') ?: '(localdb)\\MSSQLLocalDB';
        $database = getenv('PROCONTROL_DB_NAME') ?: 'devices';
        $username = getenv('PROCONTROL_DB_USER');
        $password = getenv('PROCONTROL_DB_PASSWORD');
        $username = $username === false || $username === '' ? null : $username;
        $password = $password === false || $password === '' ? null : $password;
        $dsn = 'sqlsrv:server=' . $server . ';Database=' . $database;

        $connection = new PDO(
            $dsn,
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        if (defined('PDO::SQLSRV_ATTR_QUERY_TIMEOUT')) {
            $connection->setAttribute(constant('PDO::SQLSRV_ATTR_QUERY_TIMEOUT'), 1);
        }

        return $connection;
    }

    private static function loadEnvironment(): void
    {
        $envFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
        if (!is_file($envFile)) {
            return;
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            throw new RuntimeException('Unable to read the project .env file.');
        }

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (!preg_match('/^([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(.*)$/', $line, $matches)) {
                throw new RuntimeException('Invalid .env entry on line ' . ($lineNumber + 1) . '.');
            }

            $name = $matches[1];
            $value = trim($matches[2]);
            if (strlen($value) >= 2 && (
                ($value[0] === '"' && $value[-1] === '"')
                || ($value[0] === "'" && $value[-1] === "'")
            )) {
                $value = substr($value, 1, -1);
            }

            if (getenv($name) === false) {
                putenv($name . '=' . $value);
            }
        }
    }

    private function __construct()
    {
    }
}
