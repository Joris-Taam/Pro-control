<?php

$deviceTable = PageController::deviceTable();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$archiveValue = $_POST['archive'] ?? $_GET['archive'] ?? null;

if ($archiveValue === 'true' && ($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    $archiveValue = null;
}

if ($id === false || $id === null) {
    http_response_code(400);
    $pageError = 'A valid device ID is required.';
    $record = null;
} elseif ($archiveValue !== null) {
    if (!in_array($archiveValue, ['true', 'false'], true)) {
        http_response_code(400);
        $pageError = 'The archive action is invalid.';
        $record = null;
    } else {
        try {
            PageController::setDeviceArchived($deviceTable, $id, $archiveValue === 'true');
            header('Location: Edit.php');
            exit();
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            http_response_code(500);
            $pageError = 'Could not update the device archive status.';
            $record = null;
        }
    }
} else {
    try {
        $record = PageController::findDevice($deviceTable, $id);
        if ($record === null) {
            http_response_code(404);
            $pageError = 'Device record not found.';
        }
    } catch (PDOException $exception) {
        error_log($exception->getMessage());
        http_response_code(500);
        $pageError = 'Could not load the device record.';
        $record = null;
    }
}

$escape = static fn($value): string => htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archive device</title>
    <link rel="stylesheet" href="./assets/css/global.css">
</head>
<body>
    <?php renderNavigation(); ?>
    <main class="container">
        <section class="edit-container">
            <?php if (isset($pageError)): ?>
                <p role="alert"><?= $escape($pageError) ?></p>
                <p><a href="./Edit.php">Return to devices</a></p>
            <?php elseif ($record !== null): ?>
                <h1>Archive device</h1>
                <table class="border">
                    <tbody>
                        <?php foreach ($record as $field => $value): ?>
                            <?php if (!in_array($field, ['id', 'IsArchived'], true)): ?>
                                <tr>
                                    <th scope="row"><?= $escape($field) ?></th>
                                    <td><?= $escape($value) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form class="margin" method="post">
                    <input type="hidden" name="archive" value="true">
                    <button id="delete" type="submit" onclick="return confirm('Are you sure you want to archive this device?')">Archive device</button>
                    <a href="./Edit.php">Cancel</a>
                </form>
            <?php endif; ?>
        </section>
    </main>
    <?php renderFooter(); ?>
</body>
</html>
