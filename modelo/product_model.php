<?php
require_once 'connection.php';
$conn = Connection::getConnection();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT libros_venta.*, generos.nombre_genero, usuarios.apodo AS vendedor_apodo, datos_usuario.foto_perfil
    FROM libros_venta
    JOIN usuarios ON libros_venta.id_usuario = usuarios.id
    JOIN datos_usuario ON datos_usuario.id_usuario = usuarios.id
    JOIN generos ON libros_venta.genero = generos.id_genero
    WHERE libros_venta.id='$id'";
} else {
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $row['foto_perfil'] = base64_encode($row['foto_perfil']);
    $products[] = (object) $row;
}


header("Content-Type: application/json");
echo json_encode($products);
