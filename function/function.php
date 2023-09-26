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
// get from devicestable Category
function GetCategoryData()
{

    $pdo = DBconnect();

    $sql = "SELECT Category FROM `devicestable` GROUP BY Category";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);;
}

// get from devicestable instruments
function GetInstrumentData()
{

    $pdo = DBconnect();

    $sql = "SELECT Instruments FROM `devicestable` GROUP BY Instruments";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// get from devicestable Price
function GetPriceData()
{

    $pdo = DBconnect();

    $sql = "SELECT Price FROM `devicestable` GROUP BY Price";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
