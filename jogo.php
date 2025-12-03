<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Jogo da explosao</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <div class='palavra' id='palavra'></div>
       
    <div class="caixa-jogo">
        <h1>jogo da explosao</h1>

        <div class="info-jogo">
            Pontos: <span id="pontos">0</span> 
            Tempo: <span id="tempo">0</span> 
            Vidas: <span id="vidas">3</span>
        </div>

        <p>Palavra atual:</p>
        <p><strong id="palavra-atual">exemplo</strong></p>

        <input type="text" id="entrada-palavra" placeholder="Digite aqui...">
        <br>
        <button type="button" class="botao" id="botao-enviar">OK</button>

        <div style="margin-top: 10px;">
            <button onclick="StartGame()" class="botao" id="botao-iniciar" >Iniciar</button>
            <button type="button" class="botao" id="botao-reiniciar">Reiniciar</button>
        </div>

        <div style="margin-top: 10px;">
            <a href="historico.php" class="botao-link">Histórico</a>
            <a href="placar.php" class="botao-link">Placar</a>
            <a href="TelaInicial.php" class="botao-link">Sair</a>
        </div>
    </div>

     <script src="jogo.js"></script>
    <!-- <script src="jogo.js"></script> -->
</body>
</html>
