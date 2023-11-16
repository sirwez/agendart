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