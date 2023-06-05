<?php
require_once '../includes/class/dbh.inc.php';
$conn = Connection::getConnection();


$query = "SELECT libros_venta.*, generos.nombre_genero
    FROM libros_venta
    JOIN generos ON libros_venta.genero = generos.id_genero
    ORDER BY libros_venta.id DESC";

$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}


header("Content-Type: application/json");
echo json_encode($products);
