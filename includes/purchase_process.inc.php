<?php
include_once 'class/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usu_comprador = $_POST['id_usu_comprador'];
    $id_usu_vendedor = $_POST['id_usu_vendedor'];
    $titulo = $_POST['titulo'];
    $isbn = $_POST['isbn'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $editorial = $_POST['editorial'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];
    $id_libro_venta = $_POST['id_libro'];
    $review = 0;

    // Insertar Libro en Vendidos
    $conn = Connection::getConnection();
    $stmt = $conn->prepare("INSERT INTO libros_vendidos (id_usu_comprador, id_usu_vendedor, titulo, isbn, autor, genero, editorial, estado, precio, review, id_libro_venta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssdii", $id_usu_comprador, $id_usu_vendedor, $titulo, $isbn, $autor, $genero, $editorial, $estado, $precio, $review, $id_libro_venta);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Borrar Libro de en Venta
        $stmt = $conn->prepare("DELETE FROM libros_venta WHERE id = ?");
        $stmt->bind_param("i", $id_libro_venta);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "sucess";
        } else {
            echo "Ha habido un error en el borrado";
        }
    } else {
        echo "Ha habido un error en la inserción";
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../home/home.php?error=purcheaseError");
}
