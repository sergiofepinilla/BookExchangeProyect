<?php
require_once 'connection.php';

$query = "SELECT * FROM imagenes WHERE id=" . $_GET['id'];

$conn = Connection::getConnection();

$result = $conn->query($query);

$images = array();

while ($row = $result->fetch_assoc()) {
    $images[] = (object) $row;
}

header("Content-Type: application/json");
echo json_encode($images);
