<?php
require_once 'connection.php';
$conn = Connection::getConnection();

$items_per_page = 8;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $items_per_page;

$query = "SELECT * FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero";

if (!empty($_GET['category'])) {
    $category = $_GET['category'];
    $query .= " WHERE generos.id='$category'";
}

$query .= " ORDER BY libros_venta.id DESC LIMIT $start, $items_per_page";

$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}

// Obtener el número total de páginas
$totalItemsQuery = "SELECT COUNT(*) as total FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero";
if (!empty($_GET['category'])) {
    $category = $_GET['category'];
    $totalItemsQuery .= " WHERE generos.id='$category'";
}
$totalItemsResult = $conn->query($totalItemsQuery);
$totalItems = $totalItemsResult->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $items_per_page);

$response = array(
    'products' => $products,
    'totalPages' => $totalPages
);

header("Content-Type: application/json");
echo json_encode($response);
?>
