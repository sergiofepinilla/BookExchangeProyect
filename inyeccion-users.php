<?php
require_once 'includes/dbh.inc.php';

$apodos = [];
for ($i = 2; $i <= 14; $i++) {
    $apodos[] = "Usuario $i";
}

$nombres = ["Pedro", "Ana", "Luis", "Maria", "Juan", "Lucia", "Carlos", "Sofia", "Francisco", "Isabel", "Manuel", "Teresa", "Ricardo"];
$correos = ["pedro@mail.com", "ana@mail.com", "luis@mail.com", "maria@mail.com", "juan@mail.com", "lucia@mail.com", "carlos@mail.com", "sofia@mail.com", "francisco@mail.com", "isabel@mail.com", "manuel@mail.com", "teresa@mail.com", "ricardo@mail.com"];

$carpetaImagenes = "imagenes/inyeccion/USERS/";
$imagenes = glob($carpetaImagenes . "*.jpg");
$tipo = 1;

$conn = Connection::getConnection();

// Insertar el admin primero
$hashedPassword = password_hash("admin", PASSWORD_DEFAULT);
$query = "INSERT INTO usuarios (id, apodo, tipo, correo) VALUES (1, 'admin', 2, 'admin@admin.com')";
$result = $conn->query($query);

$query = "INSERT INTO datos_usuario (id_usuario, nombre, foto_perfil) VALUES (1, 'admin', NULL)";
$result = $conn->query($query);

$query = "INSERT INTO claves (id_usuario, clave) VALUES (1, '$hashedPassword')";
$result = $conn->query($query);

// Insertar los demás usuarios
for ($i = 2; $i <= 14; $i++) {
    $apodo = $apodos[$i - 2];
    $nombre = $nombres[$i - 2]; // Asegúrate de tener suficientes nombres en el array
    $correo = $correos[$i - 2]; // Asegúrate de tener suficientes correos en el array
    $hashedPassword = password_hash(strtolower(str_replace(' ', '', $apodo)), PASSWORD_DEFAULT);
    $rutaImagen = $imagenes[$i - 2]; // Asegúrate de tener suficientes imágenes en el directorio
    $imagen = file_get_contents($rutaImagen);

    $query = "INSERT INTO usuarios (id, apodo, tipo, correo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isis", $i, $apodo, $tipo, $correo);
    $result = $stmt->execute();

    $query = "INSERT INTO datos_usuario (id_usuario, nombre, foto_perfil) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $i, $nombre, $imagen);
    $result = $stmt->execute();

    $query = "INSERT INTO claves (id_usuario, clave) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $i, $hashedPassword);
    $result = $stmt->execute();
}

header("Location:inyeccion.php");

$conn->close();
