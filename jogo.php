<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Explosive Word - Jogo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="caixa-jogo">
    <h1>Explosive Word</h1>

    <!-- informacoes principais do jogo -->
    <div class="info-jogo">
      <div>Pontuação: <strong id="pontos">0</strong></div>
      <div>Tempo: <strong id="tempo">60</strong> s</div>
      <div>Vidas: <strong id="vidas">3</strong></div>
    </div>

    <!-- area onde as palavras vao aparecer com Javascript -->
    <div class="area-jogo" id="area-jogo">
      As palavras do jogo aparecem aqui.
    </div>

    <!-- campo para digitar a palavra e botao para iniciar -->
    <div class="linha-input">
      <input
        type="text"
        id="entrada-palavra"
        placeholder="Digite a palavra aqui"
        autocomplete="off"
      >
      <button type="button" id="botao-iniciar">Iniciar</button>
    </div>

    <!-- links -->
    <div class="texto-menor" style="margin-top: 16px;">
      <a href="historico.php">Historico de partidas</a> |
      <a href="placar.php">Placar geral e ligas</a> |
      <a href="TelaInicial.php">Sair</a>
    </div>
  </div>

  <!-- <script src="jogo.js"></script> AINDA NAO TEM-->
</body>
</html>
