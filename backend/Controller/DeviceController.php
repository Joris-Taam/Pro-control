<?php

namespace ProControl\Backend\Controller;

use InvalidArgumentException;
use PDOException;
use ProControl\Backend\Entity\Device;
use ProControl\Backend\Service\DeviceService;
use Throwable;

final class DeviceController
{
    private ?DeviceService $devices;

    public function __construct(?DeviceService $devices = null)
    {
        $this->devices = $devices;
    }

    public function categoryData(): void
    {
        $category = $_GET['category'] ?? null;
        $table = $_GET['table'] ?? $_GET['table_name'] ?? null;

        if (!is_string($category) || !is_string($table)) {
            $this->json(['error' => 'A category and device table are required.'], 400);
            return;
        }

        try {
            $this->json($this->service()->getInstrumentsForCategory($table, $category));
        } catch (InvalidArgumentException $exception) {
            $this->json(['error' => $exception->getMessage()], 400);
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            $this->json(['error' => 'Could not load instruments from the database.'], 500);
        }
    }

    public function categoryPrice(): void
    {
        $instrument = $_GET['category'] ?? null;
        $table = $_GET['table'] ?? $_GET['table_name'] ?? null;

        if (!is_string($instrument) || !is_string($table)) {
            $this->json(['error' => 'An instrument and device table are required.'], 400);
            return;
        }

        try {
            $price = $this->service()->getPriceForInstrument($table, $instrument);
            if ($price === null) {
                $this->json(['error' => 'Instrument not found.'], 404);
                return;
            }

            $this->json(['price' => $price]);
        } catch (InvalidArgumentException $exception) {
            $this->json(['error' => $exception->getMessage()], 400);
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            $this->json(['error' => 'Could not load the instrument price.'], 500);
        }
    }

    public function insert(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            echo 'This endpoint only accepts POST requests.';
            return;
        }

        try {
            $table = $_POST['table_name'] ?? '';
            if (!is_string($table)) {
                throw new InvalidArgumentException('The selected device table is invalid.');
            }

            $this->service()->create($table, Device::fromFormData($_POST));
            echo 'Record inserted successfully.';
        } catch (InvalidArgumentException $exception) {
            http_response_code(400);
            echo htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            http_response_code(500);
            echo 'Could not save the device record. Check the server error log.';
        }
    }

    private function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    private function service(): DeviceService
    {
        if ($this->devices === null) {
            $this->devices = new DeviceService();
        }

        return $this->devices;
    }
}
