<!DOCTYPE html>
<html>

<head>
    <title>Upload de Imagem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Upload de Imagem</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control" id="image" name="fileToUpload" required>
            </div>
            <div class="form-group">
                <label for="comment">Comentário:</label>
                <textarea class="form-control" id="comment" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Postar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'post_image.php',
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