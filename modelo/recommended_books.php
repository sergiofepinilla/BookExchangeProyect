<?php
require_once 'connection.php';
$conn = Connection::getConnection();

if (isset($_COOKIE['genre'])) {
    $genre = $_COOKIE['genre'];
    $stmt = $conn->prepare("SELECT libros_venta.*, generos.nombre_genero
    FROM libros_venta
    JOIN generos ON libros_venta.genero = generos.id_genero
    WHERE generos.nombre_genero = ?
    ORDER BY RAND()
    LIMIT 10");
    $stmt->bind_param("s", $genre);
} else {
    $stmt = $conn->prepare("SELECT libros_venta.*, generos.nombre_genero
    FROM libros_venta
    JOIN generos ON libros_venta.genero = generos.id_genero
    ORDER BY RAND()
    LIMIT 10");
}

$stmt->execute();

$result = $stmt->get_result();

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $products[] = (object) $row;
}

header("Content-Type: application/json");
echo json_encode($products);
?>
