<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Criar Liga</title>
    <link rel="stylesheet" href="style.css">

<body>
    <div class="caixacadastro">
        <h1>Criar Liga</h1>

        <form action="#" method="post">
            <label for="leagueId">Nome da liga</label>
            <input
                type="text"
                id="leagueId"
                name="leagueId"
                maxlength="15"
                required
            />

            <div class="dica-campo">
                Máximo de 15 caracteres (use letras, números ou sublinhado).
            </div>

            <div class="acoes">
                <a href="home.php" class="botao-link">Voltar</a>
                <button type="submit" class="botao">Criar liga</button>
            </div>
        </form>
    </div>
</body>
</html>
