<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pro-Control</title>
    <?php include './function/function.php'; ?>
    <link rel="stylesheet" href="./Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <div class="container">
        <div class="edit-container">
            <?php
            $pdo = DBconnect();

            if ($pdo) {
                $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'Category';
                $orderDirection = isset($_GET['orderdir']) ? $_GET['orderdir'] : 'ASC';

                // Validate and sanitize user input for security
                $orderBy = in_array($orderBy, ['Category', 'Instruments', 'Price']) ? $orderBy : 'Category';
                $orderDirection = in_array($orderDirection, ['ASC', 'DESC']) ? $orderDirection : 'ASC';

                // Function to fetch data from the database and display the table
                function displayTable($pdo, $tableName, $orderBy, $orderDirection)
                {
                    $sql = "SELECT * FROM $tableName WHERE IsArchived = false ORDER BY $orderBy $orderDirection";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($result) > 0) {
                        echo "<table class='border' id='edit_table'>";
                        echo "<tr>
                             <th><a href='?orderby=Category&orderdir=" . ($orderBy === 'Category' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Category</a></th>
                             <th><a href='?orderby=Instruments&orderdir=" . ($orderBy === 'Instruments' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Instruments</a></th>
                             <th><a href='?orderby=Price&orderdir=" . ($orderBy === 'Price' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Price</a></th>
                             <th><a href='?orderby=AddedTime&orderdir=" . ($orderBy === 'Added_Time' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Added Time</a></th>
                             <th>Edit</th>
                             <th>Archive</th>
                         </tr>";

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["Category"] . "</td>";
                            echo "<td>" . $row["Instruments"] . "</td>";
                            echo "<td>€" . $row["Price"] . "</td>";
                            echo "<td>" . $row["Added_Time"] . "</td>";

                            // Edit link based on device type
                            $editLink = $tableName === 'cabinet_devices' ? 'edit_single_cabinet.php' : 'edit_single_field.php';

                            echo "<td><a href='$editLink?id=" . $row["id"] . "'>Edit</a></td>";

                            // Check if the record is archived, and provide the appropriate link
                            if ($row['IsArchived']) {
                                echo "<td><a href='edit.php?id=" . $row["id"] . "&archive=false'>Restore</a></td>";
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
                displayTable($pdo, 'cabinet_devices', $orderBy, $orderDirection);

                // Display Field Devices table
                echo "<h2>Field Devices</h2>";
                displayTable($pdo, 'field_devices', $orderBy, $orderDirection);
            } else {
                echo "Database connection failed.";
            }
            ?>
        </div>
    </div>

    <?php Footer() ?>
</body>

</html>