<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /agendart/posts/timeline');
    exit;
}
?>

<?php include '../partials/header.php'; ?>

<body>
    <style>
        body {
            background-color: #f4f4f4;
            /* Cor de fundo suave */
        }

        .card {
            margin-top: 100px;
            /* Espaçamento do topo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra para o cartão */
        }
    </style>
    <?php include '../partials/navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="loginForm">
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
        </div>
    </div>
    <?php include '../partials/footer.php'; ?>
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