<?php
require_once '../../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpa os dados de entrada
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insere no banco de dados
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página de login após o sucesso
        header("Location: http://localhost/agendart/src/frontend/auth/login.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
