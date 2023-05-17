<?php
require_once 'connection.php';
$conn = Connection::getConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT review.puntuacion
    FROM review
    WHERE review.id_usu_valorado = '$id'";

    $result = $conn->query($query);

    $total_score = 0;
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $total_score += $row['puntuacion'];
        $count++;
    }

    $average_score = $count > 0 ? ceil($total_score / $count) : 0;

    $response = array(
        'average_score' => $average_score,
        'num_reviews' => $count  // Aquí añado el número de revisiones
    );

    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // error
}
?>