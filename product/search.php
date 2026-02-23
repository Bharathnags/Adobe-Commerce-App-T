<?php

header('Content-Type: application/json');


$conn = mysqli_connect("localhost", "nags", "nags", "product_search");

if (!$conn) {
    echo '{"success": false, "results": []}';
    exit;
}

// Get search query
$query = $_GET['q'];
$query = str_replace(['%', '_'], ['\\%', '\\_'], $query); // Escape % and _

// Add % for partial matching
$searchTerm = "%" . $query . "%";



$sql = "SELECT id, name, description, sku, price, stock, category, image_url 
        FROM products 
        WHERE name LIKE '$searchTerm' 
        OR category LIKE '$searchTerm' 
        OR description LIKE '$searchTerm'
        OR sku LIKE '$searchTerm'
        LIMIT 10";

$data = mysqli_query($conn, $sql);

$products = [];

while ($row = mysqli_fetch_assoc($data)) {
    $products[] = $row;
}

echo json_encode([
    "success" => true,
    "count"   => count($products),
    "results" => $products
]);

mysqli_close($conn);

?>