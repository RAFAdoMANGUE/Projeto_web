<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Explosive Word - Cadastro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="acesso">
    <h1>Explosive Word</h1>
    <h2>Cadastro</h2>

    <!-- cadastro -->
    <form action="salvar.php" method="POST">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="emailUsuario" required>

      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senhaUsuario" required>

      <button type="submit">Enviar</button>
    </form>

    <div class="texto-menor">
      Já tem conta?
      <a href="TelaInicial.php">Faça login</a>
    </div>
  </div>
</body>
</html>
