<?php
require_once 'includes/class/dbh.inc.php';

$conn = Connection::getConnection();

$tables = ['usuarios', 'libros_venta', 'review', 'libros_vendidos'];

foreach ($tables as $table) {
    $query = "DELETE FROM $table";
    $result = $conn->query($query);

    if ($result) {
        echo "Se han eliminado todos los registros de la tabla $table.<br>";
    } else {
        echo "Error al eliminar los registros de la tabla $table: " . $conn->error . "<br>";
    }
}

$conn->close();
?>