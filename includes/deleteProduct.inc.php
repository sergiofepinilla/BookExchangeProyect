<?php

include_once 'dbh.inc.php';
session_start();
/*
if ($userType == 2) {
    */
    if (isset($_GET["id"])) {
        $conn = Connection::getConnection();

        $id = $_GET["id"];

        $query = "DELETE FROM productos WHERE id = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("location: ../admin/admin.php?admin=products");
    }
    /*
} else {
    header("location: ../home/home.php");
}
*/
