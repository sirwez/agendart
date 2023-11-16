<?php
$conn = new mysqli("localhost", "root", "", "agendart");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
