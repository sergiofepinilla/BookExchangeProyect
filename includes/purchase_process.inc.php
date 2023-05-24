<?php
include_once 'dbh.inc.php';

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

    /* INSERTAR LIBRO EN LIBROS VENDIDOS Y BORRAR DE LIBROS VENTA*/
    $conn = Connection::getConnection();
    $stmt = $conn->prepare("INSERT INTO libros_vendidos (id_usu_comprador, id_usu_vendedor, titulo, isbn, autor, genero, editorial, estado, precio, review, id_libro_venta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssdii", $id_usu_comprador, $id_usu_vendedor, $titulo, $isbn, $autor, $genero, $editorial, $estado, $precio, $review, $id_libro_venta);
    $stmt->execute();

    // Comprueba si se insertó la fila correctamente
    if ($stmt->affected_rows > 0) {
        // Ahora borramos el libro de la tabla 'libros_venta'
        $stmt = $conn->prepare("DELETE FROM libros_venta WHERE id = ?");
        $stmt->bind_param("i", $id_libro_venta);
        $stmt->execute();

        // Comprueba si se borró la fila correctamente
        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "error deleting book from libros_venta";
        }
    } else {
        echo "error inserting into libros_vendidos";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../error.php"); 
}
?>
