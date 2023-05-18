<?php
require_once 'connection.php';
include_once "../includes/class/user.class.php";
$conn = Connection::getConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT usuarios.apodo AS nombre_valorador, review.*, datos_usuario.foto_perfil
    FROM review
    INNER JOIN usuarios ON review.id_usu_valorador = usuarios.id
    INNER JOIN datos_usuario ON review.id_usu_valorador = datos_usuario.id_usuario
    WHERE review.id_usu_valorado = '$id'
    ORDER BY review.id DESC";

    $result = $conn->query($query);

    $reviews = array();
    $total_score = 0;
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $row['foto_perfil'] = base64_encode($row['foto_perfil']);
        $reviews[] = $row;
        $total_score += $row['puntuacion'];
        $count++;
    }

    $average_score = $count > 0 ? ceil($total_score / $count) : 0;

    $response = array(
        'reviews' => $reviews,
        'total' => count($reviews),
        'average_score' => $average_score
    );

    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // error
}
?>
