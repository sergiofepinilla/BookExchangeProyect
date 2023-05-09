<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

session_start();
$user = unserialize($_SESSION["user"]);
$userId = $user->getId();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT libros_venta.*, usuarios.apodo, usuarios.correo, datos_usuario.foto_perfil
    FROM libros_venta
    JOIN usuarios ON libros_venta.id_usuario = usuarios.id
    JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario
    WHERE libros_venta.id_usuario = '$id'
    ORDER BY libros_venta.id DESC";
} else {
   // $query = "SELECT * FROM libros_venta WHERE id_usuario = '$userId' ORDER BY id DESC";
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $row['foto_perfil'] = base64_encode($row['foto_perfil']);
    $products[] = (object) $row;
}

$response = array(
    'products' => $products,
    'total' => count($products),
);

header("Content-Type: application/json");
echo json_encode($response);
