<?php
$host = "localhost";
$db = "buonafor_akira";
$user = "buonafor_akiradmin";
$pass = "sushi2024!";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>