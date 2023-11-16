<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}
?>
<?php include '../partials/header.php'; ?>

<body>
    <style>
        /* Container da imagem */
        .image-container {
            position: relative;
            cursor: pointer;
        }

        /* Esmaecer a imagem */
        .image-container img:hover {
            opacity: 0.7;
        }

        /* Texto de sobreposição */
        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.2em;
            display: none;
        }

        /* Mostrar texto quando o mouse passa por cima da imagem */
        .image-container:hover .overlay-text {
            display: block;
        }
    </style>
    <?php include '../partials/navbar.php'; ?>
    <div class="container mt-4">
        <h2 class="mb-4">Sua Timeline</h2>
        <div id="posts"></div> <!-- Posts serão inseridos aqui -->
    </div>
    <?php include '../partials/footer.php'; ?>
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
                                    <div class="image-container" onclick="viewImage('${post.image_url}')">
                                        <img src="${post.image_url}" class="card-img" alt="Imagem da Postagem" style="max-height: 150px; object-fit: cover; width: 100%;">
                                        <div class="overlay-text">Clique para expandir</div>
                                    </div>
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
        // Carrega e atualiza posts na página a cada 5 segundos para um efeito de "tempo real".
        $(document).ready(function() {
            loadPosts(); // Carrega inicialmente
            setInterval(loadPosts, 5000); // Atualiza a cada 5 segundos
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