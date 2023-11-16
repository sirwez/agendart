<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "agendart");
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Verifica se o diretório de upload existe, se não, cria
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Define o caminho do arquivo
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é realmente uma imagem
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false) {
            echo "O arquivo não é uma imagem.";
            $uploadOk = 0;
        }
    }

    // Verifica se $uploadOk está definido como 0 por um erro
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi carregado.";
    // Se tudo estiver ok, tenta fazer o upload do arquivo
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "A imagem ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi carregada.";
            $comment = $conn->real_escape_string($_POST['comment']);
            $user_id = $_SESSION['user_id']; // Assumindo que você armazena o ID do usuário na sessão

            // Inserir no banco de dados
            $sql = "INSERT INTO posts (user_id, image_url, comment, post_timestamp) VALUES ('$user_id', '$target_file', '$comment', NOW())";
            if ($conn->query($sql) === TRUE) {
                echo "Postagem criada com sucesso.";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Houve um erro ao carregar sua imagem.";
        }
    }

    $conn->close();
}
?>
