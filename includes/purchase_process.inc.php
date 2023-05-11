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
    $review = 0;
    file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

    

    $conn = Connection::getConnection();
    $stmt = $conn->prepare("INSERT INTO libros_vendidos (id_usu_comprador, id_usu_vendedor, titulo, isbn, autor, genero, editorial, estado, precio, review) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssdi", $id_usu_comprador, $id_usu_vendedor, $titulo, $isbn, $autor, $genero, $editorial, $estado, $precio, $review);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../error.php"); // Redirige a una página de error
}
?>
