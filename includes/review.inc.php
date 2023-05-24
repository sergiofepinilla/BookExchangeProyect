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
// Inserción en Reviews
$stmt = $conn->prepare("
    INSERT INTO review (id_usu_valorado, id_usu_valorador, id_libro, comentario, puntuacion) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("iiisi", $idUsuarioVendedor, $idUsuarioComprador, $libroId, $comentario, $rating);
// Actualizar Review Boolean
if ($stmt->execute()) {
    $stmt_update = $conn->prepare("
        UPDATE libros_vendidos 
        SET review = 1 
        WHERE id = ?
    ");

    $stmt_update->bind_param("i", $rowId);
    if ($stmt_update->execute()) {
        echo "La valoración ha sido enviada correctamente.";
    } else {
        echo "Hubo un error : " . $stmt_update->error;
    }
    $stmt_update->close();
} else {
    echo "Hubo un error al enviar la valoración: " . $stmt->error;
}

$stmt->close();
$conn->close();
