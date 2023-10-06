<!DOCTYPE html>
<html>

<head>
    <title>Pro-control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <div class="container">
        <div class="button-container">
            <a href="add.php" class="index-button">Add new record</a>
            <a href="Edit.php" class="index-button">Edit existing records</a>
        </div>
        <div class="history">

            <?php
            $pdo = DBconnect();
            if ($pdo) {
                // Display the entire history table
                $sql = "SELECT * FROM `history`";
                try {
                    $stmt = $pdo->query($sql);

                    if ($stmt) {
                        echo "<h2>History Table:</h2>";
                        echo "<table border='1'>";
                        echo "<tr><th>ID</th><th>Device ID</th><th>Event Date</th><th>Event Description</th></tr>";

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['device_id'] . "</td>";
                            echo "<td>" . $row['event_date'] . "</td>";
                            echo "<td>" . $row['event_description'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Error fetching history table.";
                    }
                } catch (\PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                // Close the database connection when you're done
                $pdo = null;
            } else {
                echo "Error connecting to the database.";
            }
            ?>

        </div>
    </div>
    <?php Footer() ?>
</body>

</html>