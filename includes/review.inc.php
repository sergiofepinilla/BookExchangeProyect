<?php
include_once "../dbh.inc.php";

$rating = $_POST['rating'];
$comentario = $_POST['comentario'];
$libroId = $_POST['libroId'];
$idUsuarioVendedor = $_POST['idUsuarioVendedor'];
$idUsuarioComprador = $_POST['idUsuarioComprador'];


$conn = Connection::getConnection();

$stmt = $conn->prepare("
    INSERT INTO review (id_usu_valorado, id_usu_valorador, id_libro, comentario, puntuacion) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("iiisi", $idUsuarioVendedor, $idUsuarioComprador, $libroId, $comentario, $rating);

if ($stmt->execute()) {
    echo "La valoración ha sido enviada correctamente.";
} else {
    echo "Hubo un error al enviar la valoración: " . $stmt->error;
}

$stmt->close();
$conn->close();
