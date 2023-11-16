<?php
require 'C:\xampp\htdocs\agendart\config\config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}


// Buscar postagens
$sql = "SELECT p.*, u.username FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.post_timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - User: " . $row["username"] . " - Image: ";
        echo "<img src='" . htmlspecialchars($row["image_url"]) . "' style='width: 200px; height: auto;' />"; // Exibe a imagem
        echo " - Comment: " . $row["comment"] . "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
