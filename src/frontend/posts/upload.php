<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendart</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Agendart</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto"> <!-- Links alinhados à esquerda -->
            <?php if (isset($_SESSION['loggedin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/agendart/posts/upload">Criar Postagem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/agendart/posts/timeline">Ver Timeline</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav"> <!-- Links alinhados à direita -->
            <?php if (!isset($_SESSION['loggedin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/agendart/auth/register-page">Registrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/agendart/auth/login-page">Login</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/agendart/auth/logout">Deslogar</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
    <div class="container">
        <h2 class="mt-5 mb-4 text-center">Faça seu comentário</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control-file" id="image" name="fileToUpload" required>
            </div>
            <div class="form-group">
                <label for="comment">Comentário:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Postar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/agendart/posts/post-image',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>

</html>