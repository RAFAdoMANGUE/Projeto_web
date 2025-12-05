<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaInicial.php");
    exit;
}

require 'connection.php';

$idUsuario = (int) $_SESSION['id_usuario'];

$sql = "
    SELECT 
        p.pontos,
        p.tempo_restante,
        p.vidas_restantes,
        p.data_partida,
        l.nome AS nome_liga
    FROM partida p
    JOIN usuario u ON p.id_usuario = u.id
    LEFT JOIN liga l ON u.id_liga = l.id
    WHERE p.id_usuario = :id_usuario
    ORDER BY p.data_partida DESC
";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
$stmt->execute();
$partidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Historico</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="caixas">
        <h1>Histórico</h1>

        <table class="tabela-historico">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Pontuação</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
            <?php if (empty($partidas)): ?>
                <tr>
                    <td colspan="3" class="centro">Nenhuma partida encontrada</td>
                </tr>
            <?php else: ?>
                <?php $i = 1; ?>
                <?php foreach ($partidas as $p): ?>
                    <tr>
                        <td class="centro"><?= $i ?></td>
                        <td class="centro"><?= (int)$p['pontos'] ?></td>
                        <td class="centro">
                            <?= date('d/m/Y H:i', strtotime($p['data_partida'])) ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
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
