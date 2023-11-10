<?php
include './function/function.php';

if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    // Query the database to get the price for the selected category
    // Replace 'your_database_table' with your actual table name
    $query = "SELECT Price FROM devicetable WHERE instuments = :";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$selectedCategory]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Return the price as JSON
        $response = ['price' => $result['Price']];
        echo json_encode($response);
    } else {
        // Category not found, return an empty response or an error message
        echo json_encode(['price' => 'Category not found']);
    }
} else {
    // Handle the case where 'category' parameter is not set
    echo json_encode(['price' => 'Category not specified']);
}
?>
