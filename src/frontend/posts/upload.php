<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}
?>
<?php include '../partials/header.php'; ?>

<body>
    <?php include '../partials/navbar.php'; ?>
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
    <?php include '../partials/footer.php'; ?>
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