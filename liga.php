<?php
session_start();
require 'connection.php';

$idLiga = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($idLiga <= 0) {
    die("Liga inválida.");
}

// dados da liga
$sqlLiga = "SELECT id, nome, descricao FROM liga WHERE id = :id";
$stmtLiga = $conn->prepare($sqlLiga);
$stmtLiga->bindValue(':id', $idLiga, PDO::PARAM_INT);
$stmtLiga->execute();
$liga = $stmtLiga->fetch(PDO::FETCH_ASSOC);

if (!$liga) {
    die("Liga não encontrada.");
}

// usuário logado?
$idUsuario = $_SESSION['id_usuario'] ?? null;
$usuarioNaLiga = false;

if ($idUsuario) {
    $sqlUser = "SELECT id_liga FROM usuario WHERE id = :id";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bindValue(':id', $idUsuario, PDO::PARAM_INT);
    $stmtUser->execute();
    $idLigaUsuario = $stmtUser->fetchColumn();
    $usuarioNaLiga = ((int)$idLigaUsuario === $idLiga);
}

// participantes da liga (cada jogador só pode ter 1 id_liga)
$sqlParticipantes = "
    SELECT 
        u.nickname,
        COALESCE(p.pontos, 0) AS pontos
    FROM usuario u
    LEFT JOIN pontuacao p ON p.id_usuario = u.id
    WHERE u.id_liga = :id_liga
    ORDER BY pontos DESC, u.nickname ASC
";
$stmtPart = $conn->prepare($sqlParticipantes);
$stmtPart->bindValue(':id_liga', $idLiga, PDO::PARAM_INT);
$stmtPart->execute();
$participantes = $stmtPart->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Liga</title>
</head>
<body>
<div class="caixalig">
    <h1>Detalhes da Liga</h1>

    <h2><?= htmlspecialchars($liga['nome']) ?></h2>

    <?php if (!empty($liga['descricao'])): ?>
        <p><?= htmlspecialchars($liga['descricao']) ?></p>
    <?php endif; ?>

    <?php if ($idUsuario): ?>
        <div class="acoesliga">
            <?php if ($usuarioNaLiga): ?>
                <p>Você está participando desta liga.</p>
                <form action="sairLiga.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_liga" value="<?= $liga['id'] ?>">
                    <button type="submit" class="botao-liga">Sair da liga</button>
                </form>
            <?php else: ?>
                <p>Você ainda não está participando desta liga.</p>
                <form action="entrarLiga.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_liga" value="<?= $liga['id'] ?>">
                    <button type="submit" class="botao-liga">Entrar na liga</button>
                </form>
            <?php endif; ?>

            <a href="tabelaLigas.php" class="botao-liga">Voltar</a>
        </div>
    <?php else: ?>
        <p>Faça login para entrar ou sair desta liga.</p>
        <div class="acoesliga">
            <a href="TelaInicial.php" class="botao-liga">Ir para login</a>
        </div>
    <?php endif; ?>

    <hr>

    <h3>Participantes da liga</h3>

    <?php if (!empty($participantes)): ?>
        <table class="tabela-pontuacao">
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>Jogador</th>
                    <th>Pontuação</th>
                </tr>
            </thead>
            <tbody>
                <?php $pos = 1; ?>
                <?php foreach ($participantes as $p): ?>
                    <tr>
                        <td class="centro"><?= $pos ?></td>
                        <td class="centro"><?= htmlspecialchars($p['nickname']) ?></td>
                        <td class="centro"><?= (int)$p['pontos'] ?></td>
                    </tr>
                    <?php $pos++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum jogador participando desta liga ainda.</p>
    <?php endif; ?>
</div>
</body>
</html>
