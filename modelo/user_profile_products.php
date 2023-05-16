<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

session_start();

if (isset($_SESSION["user"])) {
    $user = unserialize($_SESSION["user"]);
    $userId = $user->getId();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT usuarios.apodo, usuarios.correo, datos_usuario.foto_perfil, datos_usuario.nombre, libros_venta.*
    FROM usuarios
    LEFT JOIN libros_venta ON usuarios.id = libros_venta.id_usuario
    INNER JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario
    WHERE usuarios.id = '$id'
    ORDER BY libros_venta.id DESC";
    
    // Consulta para contar libros vendidos
    $query_books_sold = "
    SELECT COUNT(*)
    FROM libros_vendidos
    WHERE id_usu_vendedor = '$id'";
    
    // Consulta para contar libros en venta
    $query_books_on_sale = "
    SELECT COUNT(*)
    FROM libros_venta
    WHERE id_usuario = '$id'";

} else {
    //error
}

$result = $conn->query($query);

$products = array();

while ($row = $result->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
    $row['foto_perfil'] = base64_encode($row['foto_perfil']);
    $products[] = (object) $row;
}

// Obtén la cantidad de libros vendidos
$result_books_sold = $conn->query($query_books_sold);
$books_sold = $result_books_sold->fetch_row()[0];
$books_sold = $books_sold ?? 0;

// Obtén la cantidad de libros en venta
$result_books_on_sale = $conn->query($query_books_on_sale);
$books_on_sale = $result_books_on_sale->fetch_row()[0];
$books_on_sale = $books_on_sale ?? 0;

$response = array(
    'products' => $products,
    'total' => count($products),
    'books_sold' => $books_sold, // Añade la cantidad de libros vendidos al objeto de respuesta
    'books_on_sale' => $books_on_sale, // Añade la cantidad de libros en venta al objeto de respuesta
);

header("Content-Type: application/json");
echo json_encode($response);
