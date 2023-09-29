<head>
    <title>Pro-control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<?php
navbar();
// Initialize $pdo variable
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
        $sql = "INSERT INTO devicestable (Category, Instruments, Price, DI, DO, AI, AO, TC, PT100, TSA, FI, RSxxx, TCP, Pre_Eng, Paneel_Uren, Software_PLC, Software_HMI, Test_internal, mm_Din, Cable_signal, Connector_Signal, Cable_simple, Connector_Simple)
                VALUES (:Category, :Instruments, :Price, :DI, :DO, :AI, :AO, :TC, :PT100, :TSA, :FI, :RSxxx, :TCP, :Pre_Eng, :Paneel_Uren, :Software_PLC, :Software_HMI, :Test_internal, :mm_Din, :Cable_signal, :Connector_Signal, :Cable_simple, :Connector_Simple)";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':Category', $Category);
        $stmt->bindParam(':Instruments', $Instruments);
        $stmt->bindParam(':Price', $Price);
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
?>
