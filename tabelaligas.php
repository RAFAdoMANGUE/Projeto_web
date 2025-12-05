<?php
session_start();
require 'connection.php';

// busca ligass por:
// - qtd de jogadores
// - melhor pontuação geral da liga (soma de partidas desde data_entrada_liga)
$sql = "
    SELECT 
        l.id,
        l.nome,
        COUNT(DISTINCT u.id) AS qtd_jogadores,
        COALESCE(MAX(pl.pontos_geral), 0) AS melhor_pontuacao
    FROM liga l
    LEFT JOIN usuario u 
        ON u.id_liga = l.id
    LEFT JOIN (
        SELECT 
            u2.id AS id_usuario,
            u2.id_liga,
            SUM(
                CASE 
                    WHEN p2.data_partida >= u2.data_entrada_liga
                    THEN p2.pontos
                    ELSE 0
                END
            ) AS pontos_geral
        FROM usuario u2
        LEFT JOIN partida p2 
            ON p2.id_usuario = u2.id
        GROUP BY u2.id, u2.id_liga
    ) pl 
        ON pl.id_usuario = u.id
    GROUP BY l.id, l.nome
    ORDER BY l.id DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$ligas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Tabela de Ligas</title>
</head>
<body>
<div class="caixalig">
    <h1>Tabela de Ligas</h1>

    <?php if (!empty($ligas)): ?>
        <table class="tabela-pontuacao">
            <thead>
                <tr>
                    <th>Liga</th>
                    <th>Participantes</th>
                    <th>Melhor pontuação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma liga cadastrada ainda.</p>
    <?php endif; ?>

    <br>
    <a href="home.php"><button>Voltar</button></a>
</div>
</body>
</html>
