<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Criar Liga</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="caixacadastro">
        <h1>Criar Liga</h1>

        <?php if (isset($_GET['sucesso'])): ?>
            <p style="color: green;">Liga criada com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'nome_vazio'): ?>
            <p style="color: red;">O nome da liga não pode estar vazio.</p>
        <?php endif; ?>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'duplicada'): ?>
            <p style="color: red;">Já existe uma liga com esse nome.</p>
        <?php endif; ?>

        <form action="salvarLiga.php" method="POST">

            <label for="nome">Nome da liga</label>
            <input type="text" id="nome" name="nome" maxlength="15" required>


            <label for="descricao">Descrição (opcional)</label>
            <input
                type="text"
                id="descricao"
                name="descricao"
                maxlength="40"
            />

            <div class="dica-campo">
                Máximo de 15 caracteres (use letras, números ou underline).
            </div>

            <div class="acoes">
                <a href="home.php" class="botao-link">Voltar</a>
                <button type="submit" class="botao">Criar liga</button>
            </div>
        </form>
    </div>
</body>
</html>
