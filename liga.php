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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Liga</title>


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
                
                <form action="sairLiga.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_liga" value="<?= $liga['id'] ?>">
                    <button type="submit" class="botao-liga">Sair da liga</button>
                </form>
            <?php else: ?>
                
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

</body>
</html>
