<?php
session_start();

// Destruindo a sessão
session_unset();
session_destroy();

// Redirecionando para a página de login
header('Location: /agendart/auth/login-page');
exit;
?>
