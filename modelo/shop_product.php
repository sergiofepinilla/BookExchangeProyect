<?php
require_once 'connection.php';
$conn = Connection::getConnection();

if (!empty($_GET['category']) or !empty($_GET['name'])) {
    $category = $_GET['category'];
    $query = "SELECT * FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero WHERE generos.id='$category'";
    if (!empty($_GET['name'])) {
        $name = $_GET['name'];
        $query .= " or LOWER(name) LIKE LOWER('%$name%')";
    }
    // $query .= " ORDER BY id DESC";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //  $query = "SELECT * FROM productos WHERE id='$id'";
} else {
    $query = "SELECT * FROM libros_venta INNER JOIN generos ON libros_venta.genero = generos.id_genero ORDER BY libros_venta.id DESC";
}


$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}


header("Content-Type: application/json");
echo json_encode($products);
