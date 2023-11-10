<?php
include './function/function.php';

if (isset($_GET['Instruments'])) {
    $selectedInstruments = $_GET['Instruments'];

    $pdo = DBconnect(); 

    if ($pdo === null) {
        echo json_encode(['Price' => '']);
        exit();
    }

    try {
        $query = "SELECT Price FROM devicestable WHERE Instruments = :Instruments";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':Instruments', $selectedInstruments, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Send the price as JSON response
        echo json_encode(['Price' => $result['Price']]);
    } catch (\PDOException $e) {
        echo json_encode(['Price' => '']);
    }
} else {
    echo json_encode(['Price' => '']); 
}
?>
