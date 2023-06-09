<?php // Borrar Usuario
include_once 'class/dbh.inc.php';
session_start();

if (isset($_POST["idUsuario"])) {
    $conn = Connection::getConnection();

    $id = $_POST["idUsuario"];

    $query = "DELETE FROM usuarios WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $query = "DELETE  FROM datos_usuario WHERE id_usuario = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $query = "DELETE  FROM libros_venta WHERE id_usuario = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $query = "DELETE FROM review WHERE id_usu_valorado = ? OR id_usu_valorador = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();

    echo "Usuario eliminado exitosamente.";
}
