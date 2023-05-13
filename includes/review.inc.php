<?php
include_once "dbh.inc.php";

$rating = $_POST['rating'];
$comentario = $_POST['comentario'];
$libroId = $_POST['libroId'];
$libroIdReview = $_POST['libroIdReview'];
$idUsuarioVendedor = $_POST['idUsuarioVendedor'];
$idUsuarioComprador = $_POST['idUsuarioComprador'];
$rowId = $_POST['rowId'];


$conn = Connection::getConnection();

$stmt = $conn->prepare("
    INSERT INTO review (id_usu_valorado, id_usu_valorador, id_libro, comentario, puntuacion) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("iiisi", $idUsuarioVendedor, $idUsuarioComprador, $libroId, $comentario, $rating);

if ($stmt->execute()) {
    // Preparar la consulta de actualización
    $stmt_update = $conn->prepare("
        UPDATE libros_vendidos 
        SET review = 1 
        WHERE id = ?
    ");

    // Enlazar parámetros
    $stmt_update->bind_param("i", $rowId);

    // Ejecutar consulta de actualización
    if ($stmt_update->execute()) {
        echo "La valoración ha sido enviada correctamente y se actualizó la tabla libros_vendidos.";
    } else {
        echo "Hubo un error al actualizar la tabla libros_vendidos: " . $stmt_update->error;
    }

    // Cerrar la declaración de actualización
    $stmt_update->close();
} else {
    echo "Hubo un error al enviar la valoración: " . $stmt->error;
}

$stmt->close();
$conn->close();
