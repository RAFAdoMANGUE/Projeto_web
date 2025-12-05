<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaInicial.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="caixa">
        <h1>Menu</h1>

        <div class="menu-simples">
        <a href="jogo.php" class="link-menu">Jogar</a>
        <a href="pontuacaogeral.php" class="link-menu">Pontuação geral</a>
        <a href="cadastroLigas.php" class="link-menu">Cadastrar liga</a>
        <a href="tabelaLigas.php" class="link-menu">Tabela liga</a>
        <a href="historico.php" class="link-menu">Histórico de jogos</a>
        <a href="logout.php" class="link-menu">Sair</a>
        </div>

    </div>
</body>
</html>
