<!DOCTYPE html>
<html lang="en">

<head>
    <title>Archive page</title>
    <?php include './function/function.php'; ?>
    <link rel="stylesheet" href="./Style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php Navbar(); ?>
    <div class="container">
        <div class="edit-container">
            <?php
            $pdo = DBconnect();
            // function to display the archived rows
            if ($pdo) {
                displayArchivedDevices($pdo, 'cabinet_devices', 'Cabinet');
                displayArchivedDevices($pdo, 'field_devices', 'Field');
            }
            //funtion get the data from rhe sql server
            function displayArchivedDevices($pdo, $tableName, $deviceType)
            {
                $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'Category';
                $orderDirection = isset($_GET['orderdir']) ? $_GET['orderdir'] : 'ASC';

                // Validate and sanitize user input for security
                $orderBy = in_array($orderBy, ['Category', 'Instruments', 'Price']) ? $orderBy : 'Category';
                $orderDirection = in_array($orderDirection, ['ASC', 'DESC']) ? $orderDirection : 'ASC';

                $sql = "SELECT * FROM $tableName WHERE IsArchived = 1 ORDER BY $orderBy $orderDirection";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                        echo "<td><a href='edit_single.php?id=" . $row["id"] . "'>Edit</a></td>";
                        echo "<td><a href='archive_single_$deviceType.php?id=" . $row["id"] . "&archive=false'>Restore</a></td>";
                        echo "</tr>";
                    }


                    echo "</table>";
                } else {
                    echo "<p>No archived $deviceType devices found.</p>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.restore-link').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var archive = $(this).data('archive');

                // Send AJAX request to update the archive status
                $.ajax({
                    url: 'archive.php',
                    type: 'GET',
                    data: {
                        id: id,
                        archive: archive
                    },
                    success: function(response) {
                        // Reload the page after successful update
                        location.reload();
                    },
                    error: function() {
                        alert('Error updating record.');
                    }
                });
            });
        });
    </script>

    <?php Footer(); ?>
</body>

</html>