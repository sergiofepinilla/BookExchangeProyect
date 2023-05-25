<?php   // Borrar Libro
include_once 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idLibro'])) {
        $idLibro = $_POST['idLibro'];

        $conn = Connection::getConnection();


        $stmt = $conn->prepare("DELETE FROM libros_venta WHERE id = ?");
        $stmt->bind_param("i", $idLibro);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../error.php"); 
    }
}
