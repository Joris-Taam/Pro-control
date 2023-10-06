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

                // Check if the request is for archiving or restoring a record
                if (isset($_GET['archive']) && isset($_GET['id'])) {
                    $archive = $_GET['archive'] === 'true' ? true : false;
                    $id = $_GET['id'];

                    $sql = "UPDATE devicestable SET IsArchived = :archive WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':archive', $archive, PDO::PARAM_BOOL);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo "Record " . ($archive ? "archived" : "restored") . " successfully.";
                    } else {
                        echo "Error updating record.";
                    }
                }

                $sql = "SELECT * FROM devicestable WHERE IsArchived = false ORDER BY $orderBy $orderDirection";
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
                        echo "<td><a href='edit_single.php?id=" . $row["id"] . "'>Edit</a></td>";

                        // Check if the record is archived, and provide the appropriate link
                        if ($row['IsArchived']) {
                            echo "<td><a href='edit.php?id=" . $row["id"] . "&archive=false'>Restore</a></td>";
                        } else {
                            echo "<td><a  href='archive_single.php?id=" . $row["id"] . "'>Archive</a></td>";
                        }

                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No active records found.";
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
