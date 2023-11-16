<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Acesso negado!");
}
?>
<?php include '../partials/header.php'; ?>

<body>
    <style>
        body {
            background-color: #f4f4f4;
        }

        .upload-container {
            margin-top: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #imagePreview img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
    <?php include '../partials/navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="upload-container p-4">
                    <h2 class="text-center mb-4">Faça seu comentário</h2>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Imagem:</label>
                            <input type="file" class="form-control-file" id="image" name="fileToUpload" required>
                            <div id="imagePreview" class="mt-3">
                                <!-- Preview da imagem -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comentário:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Postar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../partials/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').html(`<img src="${e.target.result}" style="max-width: 100%; height: auto;"/>`);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
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