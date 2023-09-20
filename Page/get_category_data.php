<?php
include '../function/function.php';

$pdo = DBconnect();
getCabinetData();


// Get the selected table and category from the AJAX request
if (isset($_GET["table"]) && isset($_GET["category"])) {
    $selectedTable = $_GET["table"];
    $selectedCategory = $_GET["category"];

    // Modify your SQL query to retrieve data based on the selected table and category
    $sql = "SELECT INSTRUMENTS FROM $selectedTable WHERE Category = :category";
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
