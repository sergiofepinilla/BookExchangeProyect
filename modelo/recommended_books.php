<?php
require_once 'connection.php';
$conn = Connection::getConnection();

if (isset($_COOKIE['genre'])) {
    $genre = $_COOKIE['genre'];
    $query = "SELECT libros_venta.*, generos.nombre_genero
    FROM libros_venta
    JOIN generos ON libros_venta.genero = generos.id_genero
    WHERE generos.nombre_genero = '$genre'
    ORDER BY RAND()
    LIMIT 10";
} else {
    $query = "SELECT libros_venta.*, generos.nombre_genero
    FROM libros_venta
    JOIN generos ON libros_venta.genero = generos.id_genero
    ORDER BY RAND()
    LIMIT 10";
}

$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}

header("Content-Type: application/json");
echo json_encode($products);
?>
