<?php
// function for the Navbar
function Navbar()
{
    echo '<div class="navbar">';
    echo '<ul>';
    echo '<li class="navbar-logo"><a href="index.php"><img src="../Images/logo.png" alt="Logo"></a></li>';
    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="Edit.php">Edit</a></li>';
    echo '<li><a href="add.php">Add</a></li>';
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


function InsertData() {
    
$pdo = null;

try {
    // Establish a database connection
    $pdo = DBconnect();

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from the form
        $Category = $_POST['category_name'];
        $Instruments = $_POST['category_data'];
        $Price = $_POST['category_Price'];
        $Description = $_POST['Description'];
        $DI = $_POST["quantity-DI"];
        $DO = $_POST["quantity-DO"];
        $AI = $_POST["quantity-AI"];
        $AO = $_POST["quantity-AO"];
        $TC = $_POST["quantity-TC"];
        $PT100 = $_POST["quantity-PT100"];
        $TSA = $_POST["quantity-TSA"];
        $FI = $_POST["quantity-FI"];
        $RSxxx = $_POST["quantity-RSxxx"];
        $TCP = $_POST["quantity-TCP"];
        $Pre_Eng = $_POST['pre-eng'];
        $Paneel_Uren = $_POST['paneel-uren'];
        $Software_PLC = $_POST['software-plc'];
        $Software_HMI = $_POST['software-hmi'];
        $Test_internal = $_POST['test-internal'];
        $mm_Din = $_POST['mm_Din'];
        $Cable_signal = $_POST['cable-signal'];
        $Connector_Signal = $_POST['connector-signal'];
        $Cable_simple = $_POST['cable-simple'];
        $Connector_Simple = $_POST['connector-simple'];

        // Construct the SQL query
        $sql = "INSERT INTO devicestable (Category, Instruments, Price, Description, DI, DO, AI, AO, TC, PT100, TSA, FI, RSxxx, TCP, Pre_Eng, Paneel_Uren, Software_PLC, Software_HMI, Test_internal, mm_Din, Cable_signal, Connector_Signal, Cable_simple, Connector_Simple)
                VALUES (:Category, :Instruments, :Price, :Description, :DI, :DO, :AI, :AO, :TC, :PT100, :TSA, :FI, :RSxxx, :TCP, :Pre_Eng, :Paneel_Uren, :Software_PLC, :Software_HMI, :Test_internal, :mm_Din, :Cable_signal, :Connector_Signal, :Cable_simple, :Connector_Simple)";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':Category', $Category);
        $stmt->bindParam(':Instruments', $Instruments);
        $stmt->bindParam(':Price', $Price);
        $stmt->bindParam(':Description', $Description);
        $stmt->bindParam(':DI', $DI);
        $stmt->bindParam(':DO', $DO);
        $stmt->bindParam(':AI', $AI);
        $stmt->bindParam(':AO', $AO);
        $stmt->bindParam(':TC', $TC);
        $stmt->bindParam(':PT100', $PT100);
        $stmt->bindParam(':TSA', $TSA);
        $stmt->bindParam(':FI', $FI);
        $stmt->bindParam(':RSxxx', $RSxxx);
        $stmt->bindParam(':TCP', $TCP);
        $stmt->bindParam(':Pre_Eng', $Pre_Eng);
        $stmt->bindParam(':Paneel_Uren', $Paneel_Uren);
        $stmt->bindParam(':Software_PLC', $Software_PLC);
        $stmt->bindParam(':Software_HMI', $Software_HMI);
        $stmt->bindParam(':Test_internal', $Test_internal);
        $stmt->bindParam(':mm_Din', $mm_Din);
        $stmt->bindParam(':Cable_signal', $Cable_signal);
        $stmt->bindParam(':Connector_Signal', $Connector_Signal);
        $stmt->bindParam(':Cable_simple', $Cable_simple);
        $stmt->bindParam(':Connector_Simple', $Connector_Simple);

        // Execute the statement
        $stmt->execute();

        echo "Record inserted successfully.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    if ($pdo !== null) {
        $pdo = null;
    }
}
}

function EditData() {
    
    $pdo = null;
    
    try {
        // Establish a database connection
        $pdo = DBconnect();
    
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from the form
            $Category = $_POST['newCategory'];
            $Instruments = $_POST['newInstruments'];
            $Price = $_POST['newPrice'];
            $Description = $_POST['newDescription'];
            $DI = $_POST["newDI"];
            $DO = $_POST["newDO"];
            $AI = $_POST["newAI"];
            $AO = $_POST["newAO"];
            $TC = $_POST["newTC"];
            $PT100 = $_POST["newPT100"];
            $TSA = $_POST["newTSA"];
            $FI = $_POST["newFI"];
            $RSxxx = $_POST["newRSxxx"];
            $TCP = $_POST["newTCP"];
            $Pre_Eng = $_POST['newpre_eng'];
            $Paneel_Uren = $_POST['newpaneel_uren'];
            $Software_PLC = $_POST['newsoftware_PLC'];
            $Software_HMI = $_POST['newsoftware_HMI'];
            $Test_internal = $_POST['newtest_internal'];
            $mm_Din = $_POST['newmm_Din'];
            $Cable_signal = $_POST['newcable_signal'];
            $Connector_Signal = $_POST['newcable_signal'];
            $Cable_simple = $_POST['newconnector_signal'];
            $Connector_Simple = $_POST['newCable_Simple'];
    
            // Construct the SQL query
            $sql = "INSERT INTO devicestable (Category, Instruments, Price, Description, DI, DO, AI, AO, TC, PT100, TSA, FI, RSxxx, TCP, Pre_Eng, Paneel_Uren, Software_PLC, Software_HMI, Test_internal, mm_Din, Cable_signal, Connector_Signal, Cable_simple, Connector_Simple)
                    VALUES (:Category, :Instruments, :Price, :Description, :DI, :DO, :AI, :AO, :TC, :PT100, :TSA, :FI, :RSxxx, :TCP, :Pre_Eng, :Paneel_Uren, :Software_PLC, :Software_HMI, :Test_internal, :mm_Din, :Cable_signal, :Connector_Signal, :Cable_simple, :Connector_Simple)";
    
            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':Category', $Category);
            $stmt->bindParam(':Instruments', $Instruments);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':DI', $DI);
            $stmt->bindParam(':DO', $DO);
            $stmt->bindParam(':AI', $AI);
            $stmt->bindParam(':AO', $AO);
            $stmt->bindParam(':TC', $TC);
            $stmt->bindParam(':PT100', $PT100);
            $stmt->bindParam(':TSA', $TSA);
            $stmt->bindParam(':FI', $FI);
            $stmt->bindParam(':RSxxx', $RSxxx);
            $stmt->bindParam(':TCP', $TCP);
            $stmt->bindParam(':Pre_Eng', $Pre_Eng);
            $stmt->bindParam(':Paneel_Uren', $Paneel_Uren);
            $stmt->bindParam(':Software_PLC', $Software_PLC);
            $stmt->bindParam(':Software_HMI', $Software_HMI);
            $stmt->bindParam(':Test_internal', $Test_internal);
            $stmt->bindParam(':mm_Din', $mm_Din);
            $stmt->bindParam(':Cable_signal', $Cable_signal);
            $stmt->bindParam(':Connector_Signal', $Connector_Signal);
            $stmt->bindParam(':Cable_simple', $Cable_simple);
            $stmt->bindParam(':Connector_Simple', $Connector_Simple);
    
            // Execute the statement
            $stmt->execute();
    
            echo "Record inserted successfully.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        if ($pdo !== null) {
            $pdo = null;
        }
    }
    }