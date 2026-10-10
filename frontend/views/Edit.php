<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pro-Control</title>
    <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
    <?php renderNavigation(); ?>
    <div class="container">
        <div class="edit-container">
            <?php
                $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'Category';
                $orderDirection = isset($_GET['orderdir']) ? $_GET['orderdir'] : 'ASC';

                // Validate and sanitize user input for security
                $orderBy = in_array($orderBy, ['Category', 'Instruments', 'Price', 'Added_Time'], true) ? $orderBy : 'Category';
                $orderDirection = in_array($orderDirection, ['ASC', 'DESC']) ? $orderDirection : 'ASC';

                // Function to fetch data from the database and display the table
                function displayTable($tableName, $orderBy, $orderDirection)
                {
                    $result = PageController::listDevices($tableName, false, $orderBy, $orderDirection);

                    if (count($result) > 0) {
                        echo "<table class='border' id='edit_table'>";
                        echo "<tr>
                             <th><a href='?orderby=Category&orderdir=" . ($orderBy === 'Category' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Category</a></th>
                             <th><a href='?orderby=Instruments&orderdir=" . ($orderBy === 'Instruments' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Instruments</a></th>
                             <th><a href='?orderby=Price&orderdir=" . ($orderBy === 'Price' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Price</a></th>
                             <th><a href='?orderby=Added_Time&orderdir=" . ($orderBy === 'Added_Time' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Added Time</a></th>
                             <th>Edit</th>
                             <th>Archive</th>
                         </tr>";

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["Category"] . "</td>";
                            echo "<td>" . $row["Instruments"] . "</td>";
                            echo "<td style='text-align: right;'>€" . number_format($row["Price"], 2) . "</td>";
                            echo "<td>" . $row["Added_Time"] . "</td>";

                            // Edit link based on device type
                            $editLink = $tableName === 'cabinet_devices' ? 'edit_single_cabinet.php' : 'edit_single_field.php';

                            echo "<td><a href='$editLink?id=" . $row["id"] . "'>Edit</a></td>";

                            // Check if the record is archived, and provide the appropriate link
                            if ($row['IsArchived']) {
                                echo "<td><a href='Edit.php?id=" . $row["id"] . "&archive=false'>Restore</a></td>";
                            } else {
                                // Change the link for field devices to point to archive_single_field.php
                                $archiveLink = $tableName === 'cabinet_devices' ? 'archive_single_cabinet.php' : 'archive_single_field.php';
                                echo "<td><a href='$archiveLink?id=" . $row["id"] . "'>Archive</a></td>";
                            }
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No active records found for $tableName.";
                    }
                }

                // Display Cabinet Devices table
                echo "<h2>Cabinet Devices</h2>";
                displayTable('cabinet_devices', $orderBy, $orderDirection);

                // Display Field Devices table
                echo "<h2>Field Devices</h2>";
                displayTable('field_devices', $orderBy, $orderDirection);
            ?>
        </div>
    </div>

    <?php renderFooter(); ?>
</body>

</html>