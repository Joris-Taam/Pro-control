<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <?php include '../function/function.php';?>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Pro-control</title>
        <?php
        // Your existing database connection code
        $pdo = DBconnect();

        // Get the selected category from the AJAX request
        if (isset($_GET["category"])) {
            $selectedCategory = $_GET["category"];

            // Modify your SQL query to retrieve data based on the selected category
            $sql = "SELECT INSTRUMENTS FROM cabinet WHERE Category = :category";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":category", $selectedCategory, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch data into an array
            $categoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Create an array of the 'INSTRUMENTS' values
            $instrumentNames = array_column($categoryData, 'INSTRUMENTS');

            // Return the data as JSON
            echo json_encode($instrumentNames);
        }
        ?>

    </head>
    <?php Navbar(); ?>
    <?php InsertInto(); ?>
    <?php getCabinetData() ?>

    <body id="input-body">
        <div class="input-container">
            <!-- from for the categories -->
            <form>
                <h1 class="margin">Categories</h1>
                <table>
                    <!-- Category 1 -->
                    <tr>
                        <td>
                            <select id="category_name" name="category_name" onchange="loadCategoryData()">
                                <option value="cabinet">Cabinet</option>
                                <option value="flow_control">Flow control</option>
                                <option value="flow_measurement">Flow measurement</option>
                                <option value="generic">Generic</option>
                                <option value="motor">Motor</option>
                                <option value="option">Option</option>
                                <option value="pressure_control">Pressure control</option>
                                <option value="level_measurement">Level measurement</option>
                                <option value="pump">Pump</option>
                                <option value="switch">Switch</option>
                                <option value="temperature_measurement">Temperature measurement</option>
                                <option value="valve">Valve</option>
                                <option value="others">Others</option>
                            </select>
                        </td>
                        <td>
                            <label for="category_name">Name:</label><br>
                            <select id="category_data" name="category_data">
                                <?php foreach ($cabinetData as $row) : ?>
                                    <option value="<?php echo htmlspecialchars($row['INSTRUMENTS']); ?>"><?php echo htmlspecialchars($row['INSTRUMENTS']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    <script>
function loadCategoryData() {
    // Get the selected category from the first dropdown
    var selectedCategory = document.getElementById("category_name").value;

    // Get the selected table from the table dropdown
    var selectedTable = document.getElementById("table_name").value;

    // Send an AJAX request to a PHP script to fetch data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_category_data.php?table=" + selectedTable + "&category=" + selectedCategory, true);
}
</script>



    </html>