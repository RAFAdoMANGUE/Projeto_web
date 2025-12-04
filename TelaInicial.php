<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>joguinho explosivo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="caixa">
        <h1>Login</h1>

        <form action="VerificarUsuario.php" method="POST">
            <label for="emailLogin">E-mail</label>
            <input type="email" id="emailLogin" name="emailUsuario" required>

            <label for="senhaLogin">Senha</label>
            <input type="password" id="senhaLogin" name="senhaUsuario" required>
                <div class="clique">
                    <a href="indexprojeto.php" class="cadastrar">Cadastrar</a>
                    <button type="submit" class="entrar">Entrar</button>
                </div>
        </form>
    </div>
</body>
</html>
