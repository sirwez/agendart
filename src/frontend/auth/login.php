<?php
session_start();
?>
<?php include '../partials/header.php'; ?>

<body>
    <?php include '../partials/navbar.php';?>
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
    <?php include '../partials/footer.php';?>
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