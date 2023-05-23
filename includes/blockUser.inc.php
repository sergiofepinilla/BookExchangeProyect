<?php
include_once 'dbh.inc.php';
session_start();

if (isset($_POST["idUsuario"])) {
    $conn = Connection::getConnection();

    $id = $_POST["idUsuario"];
    $query = "SELECT * FROM usuarios WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        $usuario = $resultado->fetch_assoc();
        $correo = $usuario['correo']; 

        $stmt = $conn->prepare("INSERT INTO bloqueados (correo) VALUES (?)");
        $stmt->bind_param("s", $correo);
        $stmt->execute();

        // Eliminar los registros del usuario en las otras tablas.
        $query = "DELETE FROM datos_usuario WHERE id_usuario = ?;";
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

        echo "Usuario bloqueado y registros eliminados exitosamente.";
    } else {
        echo "El usuario no existe.";
    }
}
