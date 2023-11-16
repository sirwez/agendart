<?php
$db_host = "localhost";
$db_user = "root";
$db_pw = ""; //por padrão é vazia a senha
$db = "agendart";
//cria conexao com o banco de dados
$conn = new mysqli($db_host, $db_user, $db_pw, $db);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
