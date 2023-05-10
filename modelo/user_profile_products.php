<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

session_start();
$user = unserialize($_SESSION["user"]);
$userId = $user->getId();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT usuarios.apodo, usuarios.correo, datos_usuario.foto_perfil, datos_usuario.nombre, libros_venta.*
    FROM usuarios
    LEFT JOIN libros_venta ON usuarios.id = libros_venta.id_usuario
    INNER JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario
    WHERE usuarios.id = '$id'
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
