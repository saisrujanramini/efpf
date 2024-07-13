<?php
include 'db.php';

$query = $_GET['query'];
$stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
