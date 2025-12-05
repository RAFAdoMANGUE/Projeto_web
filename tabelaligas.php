<?php
require 'connection.php';

$sql = "SELECT id, nome FROM liga ORDER BY criada_em DESC";
$stmt = $conn->query($sql);
$ligas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Tabela de Ligas</title>
    <link rel="stylesheet" href="style.css">
</head>
<tbody>
<?php if (empty($ligas)): ?>
    <tr>
        <td colspan="3" class="centro">Nenhuma liga cadastrada.</td>
    </tr>
<?php else: ?>
    <?php foreach ($ligas as $l): ?>
        <tr>
            <td><a href="liga.php?id=<?= $l['id'] ?>"><?= htmlspecialchars($l['nome']) ?></a></td>
            <td class="centro">0</td>
            <td class="centro">0</td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
</html>
