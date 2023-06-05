<?php
require_once 'includes/dbh.inc.php';

$nombres = ["Pedro Morales", "Ana Serrin", "Luis Gonzalez", "Maria Peña", "Juan Fernandez", "Lucia Gizdo", "Carlos Rosa", "Sofia Nieto", "Francisco Biyuela", "Isabel Peña", "Manuela Gonzalez", "Teresa Cifuentes", "Ricardo Hernandez"];
$correos = ["pedro@mail.com", "ana@mail.com", "luis@mail.com", "maria@mail.com", "juan@mail.com", "lucia@mail.com", "carlos@mail.com", "sofia@mail.com", "francisco@mail.com", "isabel@mail.com", "manuel@mail.com", "teresa@mail.com", "ricardo@mail.com"];

$apodos = [];

foreach ($nombres as $nombre) {
    $apodos[] = str_replace(' ', '_', $nombre);
}

$carpetaImagenes = "imagenes/inyeccion/USERS/";
$imagenes = glob($carpetaImagenes . "*.jpg");
$tipo = 1;

$conn = Connection::getConnection();

$hashedPassword = password_hash("admin", PASSWORD_DEFAULT);
$query = "INSERT INTO usuarios (id, apodo, tipo, correo) VALUES (1, 'admin', 2, 'admin@admin.com')";
$result = $conn->query($query);

$query = "INSERT INTO datos_usuario (id_usuario, nombre, foto_perfil) VALUES (1, 'admin', NULL)";
$result = $conn->query($query);

$query = "INSERT INTO claves (id_usuario, clave) VALUES (1, '$hashedPassword')";
$result = $conn->query($query);

for ($i = 2; $i <= 14; $i++) {
    $apodo = $apodos[$i - 2];
    $nombre = $nombres[$i - 2]; 
    $correo = $correos[$i - 2]; 
    $hashedPassword = password_hash(strtolower($apodo), PASSWORD_DEFAULT);
    $rutaImagen = $imagenes[$i - 2]; 
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