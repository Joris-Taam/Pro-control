<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pro-Control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
    
</head>

<body>
    <?php Navbar(); ?>

    <div class="input-container">
        <?php
        $pdo = DBconnect();

        if ($pdo) {
            $sql = "SELECT * FROM devicestable";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Category</th><th>Instruments</th><th>Price</th><th>Edit</th></tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Instruments"] . "</td>";
                    echo "<td>" . $row["Price"] . "</td>";
                    echo "<td><a href='edit_single.php?id=" . $row["id"] . "'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No records found.";
            }
        } else {
            echo "Database connection failed.";
        }
        ?>
    </div>
    <?php Footer() ?>
</body>

</html>
