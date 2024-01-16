<?php
include './function/function.php';

if (isset($_GET['category'], $_GET['table'])) {
    $selectedCategory = $_GET['category'];
    $selectedTable = $_GET['table'];

    $pdo = DBconnect(); 

    if ($pdo === null) {
        echo json_encode(['price' => 'Database connection failed']);
        exit();
    }

    try {
        // Determine the table name based on the selected option
        $tableName = ($selectedTable === 'cabinet_devices') ? 'Cabinet_devices' : 'Field_devices';

        // Query the selected table to get the price for the selected category
        $query = "SELECT Price FROM $tableName WHERE Instruments = :category";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':category', $selectedCategory, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Return the price as JSON
            $response = ['price' => $result['Price']];
            echo json_encode($response);
        } else {
            // Category not found, return an empty response or an error message
            echo json_encode(['price' => 'Category not found']);
        }
    } catch (\PDOException $e) {
        echo json_encode(['price' => 'Error fetching data from the database']);
    }
} else {
    // Handle the case where 'category' or 'table' parameters are not set
    echo json_encode(['price' => 'Category or table not specified']);
}
?>
