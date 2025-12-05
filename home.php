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
    <title>joguinho explosivo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="caixa">
        <h1>Menu</h1>
        <div>
            <ul>
                <li><b><a href="jogo.php">Jogar</a></b></li>
            </ul>
            <ul>
                <li><b><a href="pontuacaogeral.php">Pontuação geral</a></b></li>
            </ul>
            <ul>
                <li><b><a href="cadastroliga.php">Cadastrar liga</a></b></li>
            </ul>
            <ul>
                <li><b><a href="tabelaLigas.php">Tabela liga</a></b></li>
            </ul>
            <ul>
                <li><b><a href="historico.php">Historico de jogos</a></b></li>
            </ul>          
        </div>
    </div>
</body>
</html>