<?php
include '../function/function.php';

if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    $pdo = DBconnect(); 

    if ($pdo === null) {
        echo json_encode([]);
        exit();
    }

    try {
        $query = "SELECT INSTRUMENTS FROM devicestable WHERE Category = :category";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':category', $selectedCategory, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Extract the 'INSTRUMENTS' values into a simple array
        $instrumentData = array_column($result, 'INSTRUMENTS');

        echo json_encode($instrumentData);
    } catch (\PDOException $e) {
        echo json_encode([]);
    }
} else {
    echo json_encode([]); 
}
?>
