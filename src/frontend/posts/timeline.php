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

    <div class="container mt-4">
        <h2 class="mb-4">Sua Timeline</h2>
        <div id="posts"></div> <!-- Posts serão inseridos aqui -->
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function loadPosts() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost/agendart/posts/fetch',
                dataType: 'json',
                success: function(posts) {
                    if (posts.error) {
                        $('#posts').html(`<p>${posts.error}</p>`);
                        return;
                    }
                    if (posts.message) {
                        $('#posts').html(`<p>${posts.message}</p>`);
                        return;
                    }
                    var postsHtml = '';
                    posts.forEach(function(post) {
                        postsHtml += `
                    <div class="card mb-3" style="padding: 10px;">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <img src="${post.image_url}" class="card-img" alt="Imagem da Postagem" style="max-height: 150px; object-fit: cover; width: 100%; cursor: pointer;" onclick="viewImage('${post.image_url}')">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body" style="padding: 5px;">
                                    <h6 class="card-title" style="margin-bottom: 0;">${post.username}</h6>
                                    <p style="font-style: italic; margin-bottom: 5px; font-size: 0.8em;">${new Date(post.post_timestamp).toLocaleString()}</p>
                                    <p class="card-text" style="font-normal: bold; color: #333; font-size: 0.9em;">${post.comment}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    });
                    $('#posts').html(postsHtml);
                }
            });
        }

        function viewImage(imageUrl) {
            $('#modalImage').attr('src', imageUrl);
            $('#imageModal').modal('show');
        }

        $(document).ready(function() {
            loadPosts();
            setInterval(loadPosts, 5000);
        });
    </script>
    <!-- Modal para Visualização da Imagem -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Visualização da Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Imagem Ampliada">
                </div>
            </div>
        </div>
    </div>

</body>

</html>