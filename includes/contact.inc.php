<?php
if (isset($_POST["contact-submit"])) {
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
    $conn = Connection::getConnection();
    $contactName = $_POST["contactName"];
    $contactEmail = $_POST["contactEmail"];
    $contactText = $_POST["contactText"];

    if (checkEmptyValuesContact($contactName, $contactEmail, $contactText) !== false) {
        header("location: ../contact/contact.php?error=emptyFields");
        exit();
    }
    if (invalidEmail($contactEmail) !== false) {
        header("location: ../contact/contact.php?error=invalidEmail");
        exit(); // para el script
    }
    saveTicket($conn, $contactName, $contactEmail, $contactText);
    session_start();
    $_SESSION["contactSuccess"] = true;
    header("location: ../contact/contact.php");
} else {
    header("location: ../contact/contact.php?error=submitFailed");
    exit();
}
