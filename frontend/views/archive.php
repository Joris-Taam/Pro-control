<!DOCTYPE html>
<html lang="en">

<head>
    <title>Archive page</title>
    <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
    <?php renderNavigation(); ?>
    <div class="container">
        <div class="edit-container">
            <?php
            $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'Category';
            $orderDirection = isset($_GET['orderdir']) ? $_GET['orderdir'] : 'ASC';
            $orderBy = in_array($orderBy, ['Category', 'Instruments', 'Price'], true) ? $orderBy : 'Category';
            $orderDirection = in_array($orderDirection, ['ASC', 'DESC'], true) ? $orderDirection : 'ASC';
            $renderArchivedDevices = static function (
                string $tableName,
                string $deviceType,
                string $orderBy,
                string $orderDirection
            ): void {
                $result = PageController::listDevices($tableName, true, $orderBy, $orderDirection);

                if (count($result) > 0) {
                    echo "<h2>Archived $deviceType Devices</h2>";
                    echo "<table class='border' id='edit_table'>";
                    echo "<tr>
                             <th><a href='?orderby=Category&orderdir=" . ($orderBy === 'Category' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Category</a></th>
                             <th><a href='?orderby=Instruments&orderdir=" . ($orderBy === 'Instruments' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Instruments</a></th>
                             <th><a href='?orderby=Price&orderdir=" . ($orderBy === 'Price' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Price</a></th>
                             <th>Edit</th>
                             <th>Restore</th>
                         </tr>";
                    // echos with rows it displays 
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row["Category"] . "</td>";
                        echo "<td>" . $row["Instruments"] . "</td>";
                        echo "<td style='text-align: right;'>€" . number_format($row["Price"], 2) . "</td>";
                        $editLink = $tableName === 'cabinet_devices' ? 'edit_single_cabinet.php' : 'edit_single_field.php';
                        echo "<td><a href='$editLink?id=" . $row["id"] . "'>Edit</a></td>";
                        $restoreLink = $tableName === 'cabinet_devices' ? 'archive_single_cabinet.php' : 'archive_single_field.php';
                        echo "<td><a href='$restoreLink?id=" . $row["id"] . "&archive=false'>Restore</a></td>";
                        echo "</tr>";
                    }


                    echo "</table>";
                } else {
                    echo "<p>No archived $deviceType devices found.</p>";
                }
            };
            $renderArchivedDevices('cabinet_devices', 'Cabinet', $orderBy, $orderDirection);
            $renderArchivedDevices('field_devices', 'Field', $orderBy, $orderDirection);
            ?>
        </div>
    </div>

    <?php renderFooter(); ?>
</body>

</html>