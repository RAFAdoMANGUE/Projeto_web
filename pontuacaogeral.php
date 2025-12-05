<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaInicial.php");
    exit;
}
    require 'connection.php';

$sql = "
    SELECT 
        u.nickname AS jogador,
        COALESCE(l.nome, '') AS liga,
        p.pontos
    FROM pontuacao p
    JOIN usuario u ON p.id_usuario = u.id
    LEFT JOIN liga l ON u.id_liga = l.id
    ORDER BY p.pontos DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Pontuação geral</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="caixar">
        <h1>Pontuação geral</h1>

        <table class="tabela-pontuacao">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Jogador</th>
                    <th>Pontuação</th>
                </tr>
            </thead>

           <tbody>
            <?php
            if (empty($ranking)) {
                echo '<tr><td colspan="3" class="centro">Nenhuma pontuação encontrada</td></tr>';
            } else {
                $posicao = 1;
                foreach ($ranking as $linha):
            ?>
                    <tr>
                        <td class="centro"><?= $posicao ?></td>
                        <td class="centro"><?= htmlspecialchars($linha["jogador"]) ?></td>
                        <td class="centro"><?= $linha["pontos"] ?></td>
                    </tr>
            <?php
                    $posicao++;
                endforeach;
            }
            ?>
            </tbody>

        </table>

        <div class="acoesliga">
            <a href="home.php" class="botao-liga">Voltar</a>
        </div>
    </div>
</body>
</html>
