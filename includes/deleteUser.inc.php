<?php

include_once 'dbh.inc.php';
session_start();
/*
if ($userType == 2) {
*/
    if (isset($_GET["id"])) {
        $conn = Connection::getConnection();

        $id = $_GET["id"];

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

        $query = "DELETE FROM review WHERE id_usu_valorado OR id_usu_valorador = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();


        header("location: ../admin/admin.php?admin=users");
    }
    
/* REVISAR
}
else {
    echo $userType;
    //header("location: ../home/home.php");
}
*/