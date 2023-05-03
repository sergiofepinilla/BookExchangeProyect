<?php

include_once 'dbh.inc.php';
session_start();
/*
if ($userType == 2) {
*/
    if (isset($_POST["pQuantity"])) {
        $conn = Connection::getConnection();
        $id = $_POST["id"];
        $pQuantity = $_POST["pQuantity"];
        $pPrice = $_POST["pPrice"];
        $query = "UPDATE productos SET cantidad = ?, precio = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("idi", $pQuantity, $pPrice, $id);
        $stmt->execute();

        header("location: ../admin/admin.php?admin=products");
    }
    /*
} else {
    header("location: ../home/home.php");
}
*/