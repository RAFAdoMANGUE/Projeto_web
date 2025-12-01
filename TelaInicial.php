<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Explosive Word - Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login">
    <h1>Explosive Word</h1>
    <h2>Login</h2>

    <!-- login -->
    <form action="VerificarUsuario.php" method="POST">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="emailUsuario" required>

      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senhaUsuario" required>

      <button type="submit">Jogar</button>
      <button type="button" onclick="FuncChamarRegistro()">Registrar</button>
    </form>
  </div>

  <script>
    function FuncChamarRegistro() {
      window.location.href = 'indexprojeto.php';
    }
  </script>
</body>
</html>
