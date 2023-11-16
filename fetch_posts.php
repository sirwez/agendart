<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "agendart");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Buscar postagens
$sql = "SELECT p.*, u.username FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.post_time DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - User: " . $row["username"]. " - Image: " . $row["image_url"]. " - Comment: " . $row["comment"]. "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
