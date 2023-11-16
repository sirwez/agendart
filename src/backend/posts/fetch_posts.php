<?php
require_once '../../../config/config.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(["error" => "Acesso negado!"]);
    exit;
}

$sql = "SELECT * FROM posts ORDER BY post_timestamp DESC";
$result = $conn->query($sql);

$posts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Consulta para buscar o nome de usuário baseado no user_id
        $userSql = "SELECT username FROM users WHERE id = " . $row['user_id'];
        $userResult = $conn->query($userSql);
        $username = "";
        if($userResult->num_rows > 0){
            foreach($userResult as $userN){
                $username =$userN['username'];
            }
        }

        $posts[] = [
            'id' => $row["id"],
            'username' => $username, // Incluído o nome de usuário obtido pela consulta separada
            'image_url' => htmlspecialchars($row["image_url"]),
            'comment' => $row["comment"],
            'post_timestamp' => $row["post_timestamp"]
        ];
    }
    echo json_encode($posts);
} else {
    echo json_encode(["message" => "0 resultados"]);
}
$conn->close();

?>
