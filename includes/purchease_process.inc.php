<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usu_comprador = $_POST['id_usu_comprador'];
    $id_usu_vendedor = $_POST['id_usu_vendedor'];
    $nombre = $_POST['nombre'];
    $isbn = $_POST['isbn'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $editorial = $_POST['editorial'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];
    $review = 0;

    $conn = Connection::getConnection();
    $stmt = $conn->prepare("INSERT INTO libros_vendidos (id_usu_comprador, id_usu_vendedor, nombre, isbn, autor, genero, editorial, estado, precio, review) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssdi", $id_usu_comprador, $id_usu_vendedor, $nombre, $isbn, $autor, $genero, $editorial, $estado, $precio, $review);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../success.php"); // Redirige a una página de éxito
    } else {
        header("Location: ../error.php"); // Redirige a una página de error
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../error.php"); // Redirige a una página de error
}
?>
