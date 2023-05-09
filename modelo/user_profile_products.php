<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

session_start();
$user = unserialize($_SESSION["user"]);
$userId = $user->getId();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT libros_venta.*, usuarios.apodo, usuarios.correo
    FROM libros_venta
    JOIN usuarios ON libros_venta.id_usuario = usuarios.id
    WHERE libros_venta.id_usuario = '$id'
    ORDER BY libros_venta.id DESC";
} else {
   // $query = "SELECT * FROM libros_venta WHERE id_usuario = '$userId' ORDER BY id DESC";
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
