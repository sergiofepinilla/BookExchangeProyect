<?php
require_once 'connection.php';
$conn = Connection::getConnection();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT libros_venta.*, usuarios.apodo AS vendedor_apodo, usuarios.correo AS vendedor_correo FROM libros_venta JOIN usuarios ON libros_venta.id_usuario = usuarios.id WHERE libros_venta.id='$id'";
} else {
   
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}


header("Content-Type: application/json");
echo json_encode($products);
