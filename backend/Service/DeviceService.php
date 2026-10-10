<?php

namespace ProControl\Backend\Service;

use PDO;
use ProControl\Backend\Entity\Device;
use ProControl\Backend\Util\Database;
use ProControl\Backend\Util\DeviceTable;

final class DeviceService
{
    private PDO $connection;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::connect();
    }

    public function getInstrumentsForCategory(string $table, string $category): array
    {
        $tableName = DeviceTable::fromInput($table);
        $statement = $this->connection->prepare(
            "SELECT Instruments FROM $tableName WHERE Category = :category"
        );
        $statement->execute(['category' => $category]);

        return array_column($statement->fetchAll(PDO::FETCH_ASSOC), 'Instruments');
    }

    public function getPriceForInstrument(string $table, string $instrument): ?string
    {
        $tableName = DeviceTable::fromInput($table);
        $statement = $this->connection->prepare(
            "SELECT Price FROM $tableName WHERE Instruments = :instrument"
        );
        $statement->execute(['instrument' => $instrument]);
        $price = $statement->fetchColumn();

        return $price === false ? null : (string) $price;
    }

    public function getDistinctValues(string $table, string $column): array
    {
        $tableName = DeviceTable::fromInput($table);
        $allowedColumns = ['Category', 'Instruments', 'Price'];
        if (!in_array($column, $allowedColumns, true)) {
            throw new \InvalidArgumentException('The selected device field is invalid.');
        }

        $statement = $this->connection->query(
            "SELECT $column FROM $tableName GROUP BY $column"
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listDevices(string $table, bool $archived, string $orderBy, string $direction): array
    {
        $tableName = DeviceTable::fromInput($table);
        $allowedColumns = ['Category', 'Instruments', 'Price', 'Added_Time'];
        if (!in_array($orderBy, $allowedColumns, true)) {
            $orderBy = 'Category';
        }
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $statement = $this->connection->query(
            "SELECT * FROM $tableName WHERE IsArchived = " . ($archived ? '1' : '0')
            . " ORDER BY $orderBy $direction"
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(string $table, int $id): ?array
    {
        $tableName = DeviceTable::fromInput($table);
        $statement = $this->connection->prepare(
            "SELECT * FROM $tableName WHERE id = :id"
        );
        $statement->execute(['id' => $id]);
        $device = $statement->fetch(PDO::FETCH_ASSOC);

        return $device === false ? null : $device;
    }

    public function updateFromForm(string $table, int $id, array $formData): void
    {
        $tableName = DeviceTable::fromInput($table);
        $fields = [
            'Category' => 'newCategory',
            'Instruments' => 'newInstruments',
            'Price' => 'newPrice',
            'Description' => 'newDescription',
            'DI' => 'newDI',
            'DO' => 'newDO',
            'AI' => 'newAI',
            'AO' => 'newAO',
            'TC' => 'newTC',
            'PT100' => 'newPT100',
            'TSA' => 'newTSA',
            'FI' => 'newFI',
            'RSxxx' => 'newRSxxx',
            'TCP' => 'newTCP',
            'Pre_Eng' => 'newpre_eng',
            'Paneel_Uren' => 'newpaneel_uren',
            'Software_PLC' => 'newsoftware_PLC',
            'Software_HMI' => 'newsoftware_HMI',
            'Test_internal' => 'newtest_internal',
            'mm_Din' => 'newmm_Din',
            'Cable_signal' => 'newcable_signal',
            'Connector_Signal' => 'newConnector_Signal',
            'Cable_simple' => 'newCable_Simple',
            'Connector_Simple' => 'newConnector_Simple',
            'Added_Time' => 'newAdded_Time',
        ];
        $assignments = [];
        $values = [];

        foreach ($fields as $column => $inputName) {
            $assignments[] = "$column = :$column";
            $values[$column] = $formData[$inputName] ?? null;
        }

        $values['id'] = $id;
        $statement = $this->connection->prepare(
            "UPDATE $tableName SET " . implode(', ', $assignments) . ' WHERE id = :id'
        );
        $statement->execute($values);
    }

    public function setArchived(string $table, int $id, bool $archived): void
    {
        $tableName = DeviceTable::fromInput($table);
        $statement = $this->connection->prepare(
            "UPDATE $tableName SET IsArchived = :archived WHERE id = :id"
        );
        $statement->execute(['archived' => $archived, 'id' => $id]);
    }

    public function create(string $table, Device $device): void
    {
        $tableName = DeviceTable::fromInput($table);
        $values = $device->toDatabaseValues();
        $columns = array_keys($values);
        $columnList = implode(', ', $columns);
        $parameterList = implode(', ', array_map(
            static fn(string $column): string => ':' . $column,
            $columns
        ));

        $statement = $this->connection->prepare(
            "INSERT INTO $tableName ($columnList) VALUES ($parameterList)"
        );
        $statement->execute($values);
    }
}
