<?php
session_start();
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
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <form id="loginForm" class="mt-5">
                    <h2 class="text-center">Login</h2>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="button" onclick="submitForm()" class="btn btn-primary btn-block">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    function submitForm() {
        var formData = $("#loginForm").serialize();

        $.ajax({
            type: "POST",
            url: "http://localhost/agendart/auth/login",
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Redirecionar em caso de sucesso
                    window.location.href = "http://localhost/agendart/posts/timeline";
                } else {
                    // Exibir mensagem de erro
                    alert(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


</body>

</html>