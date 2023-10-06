<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archive page</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
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

                    if (isset($_GET['archive']) && isset($_GET['id'])) {
                        $archive = $_GET['archive'] === 'true' ? 0 : 1; 
                        $id = $_GET['id'];

                        $sql = "UPDATE devicestable SET IsArchived = :archive WHERE id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':archive', $archive, PDO::PARAM_INT);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                        if ($stmt->execute()) {
                            echo "Record " . ($archive === 0 ? "archived" : "restored") . " successfully.";
                        } else {
                            echo "Error updating record.";
                        }
                    }

                    $sql = "SELECT * FROM devicestable WHERE IsArchived = 1 ORDER BY $orderBy $orderDirection";

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
                             <th>archived</th>
                         </tr>";

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["Category"] . "</td>";
                            echo "<td>" . $row["Instruments"] . "</td>";
                            echo "<td>€" . $row["Price"] . "</td>";
                            echo "<td><a href='edit_single.php?id=" . $row["id"] . "'>Edit</a></td>";
                            echo "<td><a href='#' class='archive-link' data-id='" . $row["id"] . "' data-archive='" . ($row["IsArchived"] === '1' ? 'true' : 'false') . "'>" . ($row["IsArchived"] === '1' ? 'Restore' : 'Restore') . "</a></td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No archived devices found.";
                    }
                }
            ?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.archive-link').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var archive = $(this).data('archive');

                // Send AJAX request to update the archive status
                $.ajax({
                    url: 'archive.php',
                    type: 'GET',
                    data: { id: id, archive: archive },
                    success: function (response) {
                        // Reload the page after successful update
                        location.reload();
                    },
                    error: function () {
                        alert('Error updating record.');
                    }
                });
            });
        });
    </script>

    <?php Footer(); ?>
</body>
</html>
