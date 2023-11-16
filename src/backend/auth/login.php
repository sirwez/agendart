<?php
require 'C:\xampp\htdocs\agendart\config\config.php';
session_start();

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
            echo "Bem-vindo " . $row['username'] . "!";
        } else {
            // Senha incorreta
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado.";
    }
    $conn->close();
}
?>
