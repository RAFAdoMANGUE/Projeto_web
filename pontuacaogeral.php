<?php
    require 'connection.php';

$sql = "
    SELECT jogador, pontos FROM pontuacao ORDER BY pontos DESC
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #ccccff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .caixa {
            background: #ffffff;
            border: 1px solid #000;
            padding: 20px;
            width: 600px;
            box-sizing: border-box;
            text-align: left;
        }

        .caixa h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 15px;
        }

        .tabela-pontuacao {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .tabela-pontuacao th,
        .tabela-pontuacao td {
            border: 1px solid #000;
            padding: 6px 8px;
        }

        .tabela-pontuacao th {
            text-align: center;
        }

        .centro {
            text-align: center;
        }

        .acoes {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
        }

        .botao-next,
        .botao-link {
            padding: 6px 16px;
            font-size: 14px;
            background: #dddddd;
            border: 1px solid #000;
            color: #000;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="caixa">
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
                // Nenhum resultado encontrado
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

        <div class="acoes">
            <a href="home.php" class="botao-link">Voltar</a>
        </div>
    </div>
</body>
</html>
