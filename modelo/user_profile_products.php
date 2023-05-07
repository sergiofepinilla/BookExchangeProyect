<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

session_start();
$user = unserialize($_SESSION["user"]);
$userId = $user->getId();

if (!empty($_GET['category']) or !empty($_GET['name'])) {
    $category = $_GET['category'];
    // $query = "SELECT * FROM productos WHERE categoria='$category'";
    if (!empty($_GET['name'])) {
        $name = $_GET['name'];
        $query .= " or LOWER(name) LIKE LOWER('%$name%')";
    }
    // $query .= " ORDER BY id DESC";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //  $query = "SELECT * FROM productos WHERE id='$id'";
} else {
    $query = "SELECT * FROM libros_venta WHERE id_usuario = '$userId' ORDER BY id DESC";
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}

$response = array(
    'products' => $products,
    'total' => count($products),
);

header("Content-Type: application/json");
echo json_encode($response);
