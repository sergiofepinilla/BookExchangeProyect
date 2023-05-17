<?php
require_once 'includes/dbh.inc.php';
$conn = Connection::getConnection();

$usuario = 4; // ID del usuario
$titulo = "Libro de prueba";
$isbn = 1231231232; // ISBN de 10 dígitos
$editorial = "Editorial de prueba";
$genero = 1; // ID del género
$estado = "Nuevo";
$precio = 10.99;
$cambio = 0; // No está disponible para cambio
$envio = 1; // Está disponible para envío
$descripcion = "Descripción del libro de prueba";
$imagen = file_get_contents("imagenes/inyeccion/IMG/A Court of Mist and Fury.jpg"); // Ruta a la imagen que deseas utilizar
$autor = "Autor de prueba";
$tituloEscaped = mysqli_real_escape_string($conn, $titulo);
$editorialEscaped = mysqli_real_escape_string($conn, $editorial);

$query = "INSERT INTO libros_venta (id_usuario, titulo, isbn, editorial, genero, estado, precio, cambio, envio, descripcion, imagen, autor)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("isssisdiissb", $usuario, $tituloEscaped, $isbn, $editorialEscaped, $genero, $estado, $precio, $cambio, $envio, $descripcion, $imagen, $autor);

$result = $stmt->execute();

if (!$result) {
    echo "Error al insertar el libro: " . $stmt->error;
} else {
    echo "Libro insertado correctamente.";
}

$stmt->close();
$conn->close();

?>
