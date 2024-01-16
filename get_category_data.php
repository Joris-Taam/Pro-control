<?php
include './function/function.php';

if (isset($_GET['category'], $_GET['table_name'])) {
    $selectedCategory = $_GET['category'];
    $selectedTable = $_GET['table_name'];

    $pdo = DBconnect(); 

    if ($pdo === null) {
        echo json_encode([]);
        exit();
    }

    try {
        // Determine the table name based on the selected option
        $tableName = ($selectedTable === 'cabinet_devices') ? 'Cabinet_devices' : 'Field_devices';

        // Query the selected table for the specified category
        $query = "SELECT Instruments FROM $tableName WHERE Category = :category";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':category', $selectedCategory, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Extract the 'Instruments' values into a simple array
        $instrumentData = array_column($result, 'Instruments');

        echo json_encode($instrumentData);
    } catch (\PDOException $e) {
        echo json_encode([]);
    }
} else {
    echo json_encode([]); 
}
