<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../partials/header.php'; ?>

<body>
    <?php include '../partials/navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <form id="registerForm" class="mt-5">
                    <h2 class="text-center">Registrar</h2>
                    <div class="form-group">
                        <label for="username">Nome de Usuário:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" class="form-control" id="passwordInput" required>
                        <small id="passwordHelp" class="form-text text-muted"></small>
                    </div>
                    <button type="button" onclick="submitForm()" class="btn btn-primary btn-block">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../partials/footer.php'; ?>
    <script>
        var isPasswordValid = false; // Estado inicial da validade da senha

        $(document).ready(function() {
            $("#passwordInput").keyup(function() {
                var password = $(this).val();
                validatePassword(password);
            });
        });

        function validatePassword(password) {
            var messages = [];
            isPasswordValid = true; // Resetando para um estado válido inicial

            if (password.length < 8) {
                messages.push("A senha deve ter pelo menos 8 caracteres.");
                isPasswordValid = false;
            }
            if (!/[A-Z]/.test(password)) {
                messages.push("A senha deve conter pelo menos uma letra maiúscula.");
                isPasswordValid = false;
            }
            if (!/\d/.test(password)) {
                messages.push("A senha deve conter pelo menos um número.");
                isPasswordValid = false;
            }
            if (!/[^a-zA-Z\d]/.test(password)) {
                messages.push("A senha deve conter pelo menos um caractere especial.");
                isPasswordValid = false;
            }

            $("#passwordHelp").html(messages.join("<br>"));
        }

        function submitForm() {
            if (!isPasswordValid) {
                alert("Por favor, corrija os erros na senha antes de enviar.");
                return;
            }
            var username = $("input[name='username']").val();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();

            // Validar e-mail
            if (!validateEmail(email)) {
                alert("Por favor, insira um e-mail válido.");
                return;
            }

            $.ajax({
                type: "POST",
                url: "http://localhost/agendart/auth/register", // Ajuste conforme o caminho correto do seu endpoint
                data: {
                    username: username,
                    email: email,
                    password: password
                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        alert(response.message); // Exibe mensagem de erro
                    } else {
                        window.location.href = 'http://localhost/agendart/auth/login-page'; // Redireciona para login
                    }
                },
                error: function(error) {
                    console.error("Erro na requisição: ", error);
                }
            });
        }

        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
</body>

</html>