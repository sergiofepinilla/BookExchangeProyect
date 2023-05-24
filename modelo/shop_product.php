<?php
require_once '../includes/dbh.inc.php';
$conn = Connection::getConnection();

$items_per_page = 12;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $items_per_page;

$query = "SELECT * FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero";
$conditions = array();

if (isset($_GET['query']) && $_GET['query'] != "") {
    $searchQuery = $_GET['query'];
    $conditions[] = "libros_venta.autor LIKE '%$searchQuery%'";
    $conditions[] = "libros_venta.titulo LIKE '%$searchQuery%'";
    $conditions[] = "generos.nombre_genero LIKE '%$searchQuery%'";
    $conditions[] = "libros_venta.isbn LIKE '%$searchQuery%'";
}

if (isset($_GET['category']) && $_GET['category'] != "") {
    $category = $_GET['category'];
    $conditions[] = "generos.id_genero= '$category'";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" OR ", $conditions);
}

$query .= " ORDER BY libros_venta.id DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $start, $items_per_page);

$stmt->execute();
$result = $stmt->get_result();

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}

// Obtener Numero Total Páginas
$totalItemsQuery = "SELECT COUNT(*) as total FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero";

if (!empty($conditions)) {
    $totalItemsQuery .= " WHERE " . implode(" OR ", $conditions);
}

$stmt = $conn->prepare($totalItemsQuery);
$stmt->execute();
$totalItemsResult = $stmt->get_result();
$totalItems = $totalItemsResult->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $items_per_page);

$categoryName = "";

if (isset($_GET['category']) && $_GET['category'] != "") {
    $category = $_GET['category'];
    $stmt = $conn->prepare("SELECT nombre_genero FROM generos WHERE id_genero= ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $categoryName = $result->fetch_assoc()['nombre_genero'];
    }
}

$response = array(
    'products' => $products,
    'totalPages' => $totalPages,
    'categoryName' => $categoryName
);

header("Content-Type: application/json");
echo json_encode($response);
