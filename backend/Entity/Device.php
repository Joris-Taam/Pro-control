<?php

namespace ProControl\Backend\Entity;

final class Device
{
    private array $values;

    private function __construct(array $values)
    {
        $this->values = $values;
    }

    public static function fromFormData(array $formData): self
    {
        $fields = [
            'Category' => 'category_name',
            'Instruments' => 'category_data',
            'Price' => 'category_Price',
            'Description' => 'Description',
            'DI' => 'quantity-DI',
            'DO' => 'quantity-DO',
            'AI' => 'quantity-AI',
            'AO' => 'quantity-AO',
            'TC' => 'quantity-TC',
            'PT100' => 'quantity-PT100',
            'TSA' => 'quantity-TSA',
            'FI' => 'quantity-FI',
            'RSxxx' => 'quantity-RSxxx',
            'TCP' => 'quantity-TCP',
            'Pre_Eng' => 'pre-eng',
            'Paneel_Uren' => 'paneel-uren',
            'Software_PLC' => 'software-plc',
            'Software_HMI' => 'software-hmi',
            'Test_internal' => 'test-internal',
            'mm_Din' => 'mm_Din',
            'Cable_signal' => 'cable-signal',
            'Connector_Signal' => 'connector-signal',
            'Cable_simple' => 'cable-simple',
            'Connector_Simple' => 'connector-simple',
        ];

        $values = [];
        foreach ($fields as $column => $inputName) {
            $values[$column] = $formData[$inputName] ?? null;
        }

        $values['Added_Time'] = date('Y-m-d');

        return new self($values);
    }

    public function toDatabaseValues(): array
    {
        return $this->values;
    }
}
