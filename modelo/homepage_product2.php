<?php
require_once 'connection.php';
$conn = Connection::getConnection();

if (!empty($_GET['category']) or !empty($_GET['name'])) {
    $category = $_GET['category'];
    $query = "SELECT * FROM libros_venta WHERE genero='$category'";
    if (!empty($_GET['name'])) {
        $name = $_GET['name'];
        $query .= " or LOWER(nombre) LIKE LOWER('%$name%')";
    }
    $query .= " ORDER BY id DESC";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT libros_venta.*, usuarios.apodo AS vendedor_apodo, usuarios.correo AS vendedor_correo FROM libros_venta JOIN usuarios ON libros_venta.id_usuario = usuarios.id WHERE libros_venta.id='$id'";
} else {
    $query = "SELECT * FROM libros_venta ORDER BY id DESC";
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}


header("Content-Type: application/json");
echo json_encode($products);
