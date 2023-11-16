<?php
require_once '../../../config/config.php';
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpa os dados de entrada
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifica se o e-mail já está cadastrado
    $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo json_encode(["error" => true, "message" => "Email já cadastrado."]);
    } else {
        // Insere no banco de dados
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["error" => false, "message" => "Usuário registrado com sucesso."]);
        } else {
            echo json_encode(["error" => true, "message" => "Erro ao registrar usuário: " . $conn->error]);
        }
    }

    $conn->close();
}
?>
