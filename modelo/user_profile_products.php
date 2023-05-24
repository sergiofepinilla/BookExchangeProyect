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

    // Consulta para obtener los datos del usuario
    $query_user = "
    SELECT usuarios.apodo, usuarios.correo, datos_usuario.foto_perfil, datos_usuario.nombre
    FROM usuarios
    INNER JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario
    WHERE usuarios.id = '$id'";

    // Consulta para obtener los productos del usuario
    $query_products = "
    SELECT libros_venta.*
    FROM libros_venta
    WHERE libros_venta.id_usuario = '$id'
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

$result_user = $conn->query($query_user);
$user_info = $result_user->fetch_assoc();
$user_info['foto_perfil'] = base64_encode($user_info['foto_perfil']);

$result_products = $conn->query($query_products);
$products = array();

while ($row = $result_products->fetch_assoc()) {
    $row['imagen'] = base64_encode($row['imagen']);
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
    'user_info' => $user_info,  // Añade los datos del usuario al objeto de respuesta
    'products' => $products,
    'total' => count($products),
    'books_sold' => $books_sold, 
    'books_on_sale' => $books_on_sale,
);

header("Content-Type: application/json");
echo json_encode($response);
?>
