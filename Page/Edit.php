<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pro-Control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
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

            $sql = "SELECT * FROM devicestable ORDER BY $orderBy $orderDirection";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                echo "<table class='border' id='edit_table'>"; 
                echo "<tr>
                 <th><a href='?orderby=Category&orderdir=" . ($orderBy === 'Category' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Category</a></th>
                 <th><a href='?orderby=Instruments&orderdir=" . ($orderBy === 'Instruments' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Instruments</a></th>
                 <th><a href='?orderby=Price&orderdir=" . ($orderBy === 'Price' && $orderDirection === 'ASC' ? 'DESC' : 'ASC') . "'>Price</a></th>
                 <th>Edit</th>
                 <th>Delete</th>
             </tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Instruments"] . "</td>";
                    echo "<td>" . $row["Price"] . "</td>";
                    echo "<td><a  href='edit_single.php?id=" . $row["id"] . "'>Edit</a></td>";
                    echo "<td><a  href='delete_single.php?id=" . $row["id"] . "'>Delete</a></td>";
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
</div>


    <?php Footer() ?>
</body>

</html>