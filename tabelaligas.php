<?php
require 'connection.php';

$sql = "
    SELECT 
        l.id,
        l.nome,
        COUNT(DISTINCT u.id) AS qtd_jogadores,
        COALESCE(MAX(p.pontos), 0) AS melhor_pontuacao
    FROM liga l
    LEFT JOIN usuario u ON u.id_liga = l.id
    LEFT JOIN pontuacao p ON p.id_usuario = u.id
    GROUP BY l.id, l.nome
    ORDER BY l.id DESC
";

$stmt = $conn->query($sql);
$ligas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Tabela de Ligas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="caixam">  
    <h1>Tabela de Ligas</h1>

    <table class="tabela-liga">
        <thead>
            <tr>
                <th>Liga</th>
                <th>Participantes</th>
                <th>Melhor pontuação</th>
                <th>Ação</th>
        </thead>

        <tbody>
        <?php if (empty($ligas)): ?>
            <tr>
                <td colspan="3" class="centro">Nenhuma liga cadastrada.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($ligas as $l): ?>
                <tr>
                    <td>
                        <a href="liga.php?id=<?= $l['id'] ?>">
                            <?= htmlspecialchars($l['nome']) ?>
                        </a>
                    </td>
                    <td class="centro"><?= (int)$l['qtd_jogadores'] ?></td>
                    <td class="centro"><?= (int)$l['melhor_pontuacao'] ?></td>
                    <td>
                        <a href="liga.php?id=<?= $l['id'] ?>" class="botao-liga">Ver / Entrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="acoesliga">
        <a href="home.php" class="botao-liga">Voltar</a>
    </div>
</div>

</body>
</html>
