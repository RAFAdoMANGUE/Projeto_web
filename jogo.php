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
    <title>Jogo da explosao</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='objetoBomba' id='objetoBomba'></div>
    <div class='palavra' id='palavra'></div>
       
    <div class="caixa-jogo">
        <h1>jogo da explosao</h1>

        <div class="info-jogo">
            Pontos: <span id="pontos">0</span> 
            Tempo: <span id="tempo">0</span> 
            Vidas: <span id="vidas">3</span>
        </div>

        <p>Palavra atual:</p>
        <p><strong id="palavra-atual"></strong></p>

        <input type="text" id="entrada-palavra" placeholder="PALAVRA AQUI">
        <br>

        <div class="botoes">
            <button onclick="StartGame()" class="botao" id="botao-iniciar">Iniciar</button>
            <button onclick="endGame()" class="botao" id="botao-reiniciar">Encerrar</button>
        <!-- <button onclick="salvarPontos()" class="botao" id="botao-salvar" disabled>Salvar pontos</button> -->
            <a href="home.php"><button type="button" class="botao" id="botao-sair">Sair</button></a>
        </div>
    </div>

    <script src="jogo.js"></script>
</body>
</html>
