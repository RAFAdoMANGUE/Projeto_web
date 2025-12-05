<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - jogo da explosão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="caixa">
        <h1>Cadastro</h1>

        <form action="salvarUsuario.php" method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="emailUsuario" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senhaUsuario" required>

            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" required>

            <button type="submit" class="botao">Cadastrar</button>
        </form>

        <div>
            <a href="TelaInicial.php" class="botao-link">Ir para Login</a>
        </div>
    </div>
</body>
</html>
