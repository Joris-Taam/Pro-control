<?php
// function for the Navbar
function Navbar()
{
    echo '<div class="navbar">';
    echo '<ul>';
    echo '<li class="navbar-logo"><a href="index.php"><img src="../Images/logo.png" alt="Logo"></a></li>';
    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="Edit.php">Edit</a></li>';
    echo '<li><a href="Input.php">Input</a></li>';
    echo '</ul>';
    echo '</div>';
}

?>
<?php
// function for the footer
function Footer()
{
    echo '<footer>';
    echo '<div>';
    echo '<a id="footer-copyright" href="index.php">Copyright &copy;2023 - 2024 All rights reserved | Pro-control</a>';
    echo '</div>';
    echo '</footer>';
}

// function for the Database connetion
function DBconnect()
{
    $localhost = 'localhost';
    $db = 'Devices';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$localhost;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Return the PDO object for database operations
    } catch (\PDOException $e) {
        echo 'error connecting to database: ' . $e->getMessage();
        return null; // Return null to indicate a failed connection
    }
}   



// Function to insert data into the "devices" table and add a history log entry
function InsertInto()
{
    // Get a PDO connection using the DBconnect() function
    $pdo = DBconnect();

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $categories = $_POST["categories"];
        $instrument = $_POST["instrument"];
        $price = $_POST["price"];

        // Define your SQL query to insert data into the "devices" table
        $sqlInsert = "INSERT INTO devices (categories, instrument, price) 
            VALUES (:categories, :instrument, :price)";

        // Define your SQL query to insert a history log entry
        $sqlHistory = "INSERT INTO history_log (date, categories, instrument, price,) 
            VALUES (NOW(), :categories, :instrument, :price)";

        try {
            // Start a transaction
            $pdo->beginTransaction();

            // Prepare and execute the insert into "devices" table
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(":categories", $categories);
            $stmtInsert->bindParam(":instrument", $instrument);
            $stmtInsert->bindParam(":price", $price);
            $stmtInsert->execute();

            // Prepare and execute the insert into "history_log" table
            $stmtHistory = $pdo->prepare($sqlHistory);
            $stmtHistory->bindParam(":categories", $categories);
            $stmtHistory->bindParam(":instrument", $instrument);
            $stmtHistory->bindParam(":price", $price);
            $stmtHistory->execute();

            // Commit the transaction
            $pdo->commit();

            // Show a success message
            echo '<script>alert("New record created successfully");</script>';
        } catch (PDOException $e) {
            // Roll back the transaction on error
            $pdo->rollBack();
            // Handle any database-related errors
            echo "Error: " . $e->getMessage();
        }
    }
}

// Function to retrieve the history of added items along with the timestamp, categories, instrument, and price
function History()
{
    // Get a PDO connection using the DBconnect() function
    $pdo = DBconnect();
    $sql = "SELECT date, categories, instrument, price FROM history_log ORDER BY date DESC";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Fetch and display history log entries
        echo '<h1>History Logs</h1>';
        echo '<table>';
        echo '<tr><th>Date</th><th>Categories</th><th>Instrument</th><th>Price</th></tr>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['categories'] . '</td>';
            echo '<td>' . $row['instrument'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// get data from Cabinet table
function getCabinetData() {

    $pdo = DBconnect();

    $sql = "SELECT INSTRUMENTS FROM cabinet";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $cabinetData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $cabinetData;
}

// Call the function to retrieve cabinet data
$cabinetData = getCabinetData();


function FetchDataCabinet() { 
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
}

?>
