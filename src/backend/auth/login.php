<?php
require_once '../../../config/config.php';
session_start();
$response = ["success" => false, "message" => ""];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Uso do "real_escape_string" para evitar ataques de injeção SQL.
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Verifica no banco de dados o usuário
    $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login bem-sucedido, insere os dados na sessão
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
