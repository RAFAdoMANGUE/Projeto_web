<?php
session_start();

// limpa variáveis de sessão
session_unset();

// destrói a sessão
session_destroy();

// apaga o cookie do jogador (se estiver usando)
if (isset($_COOKIE['jogador'])) {
    setcookie('jogador', '', time() - 3600, "/");
}

// redireciona para a tela de login
header("Location: TelaInicial.php");
exit;
