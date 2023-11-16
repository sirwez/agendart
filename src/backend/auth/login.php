<?php
require_once '../../../config/config.php';
session_start();
$response = ["success" => false, "message" => ""];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Verifica no banco de dados
    $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login bem-sucedido
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $response = ["success" => true, "message" => "Bem-vindo " . $row['username'] . "!"];
        } else {
            $response = ["success" => false, "message" => "Senha incorreta!"];
        }
    } else {
        $response = ["success" => false, "message" => "Usuário não encontrado."];
    }
    $conn->close();
}
echo json_encode($response);
?>
