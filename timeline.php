<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Linha do Tempo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Linha do Tempo</h2>
        <div id="posts"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadPosts() {
                $.ajax({
                    type: 'GET',
                    url: 'fetch_posts.php',
                    success: function(response) {
                        $('#posts').html(response);
                    }
                });
            }

            loadPosts(); // Carrega as postagens quando a página é carregada
        });
    </script>
</body>

</html>