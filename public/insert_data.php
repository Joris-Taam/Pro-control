<?php
require_once dirname(__DIR__) . '/backend/bootstrap.php';
(new ProControl\Backend\Controller\DeviceController())->insert();
