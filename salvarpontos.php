<?php
session_start();
require 'connection.php';

$pontos = isset($_POST['pontos']) ? (int) $_POST['pontos'] : 0;
$jogador = $_COOKIE['jogador'] ?? 'Desconhecido';


$idUsuario = (int) $_SESSION['id_usuario'];

if ($pontos <= 0) {
    die("Sem pontos para salvar");
}

$sql = "
    INSERT INTO pontuacao (jogador, pontos)
    VALUES (:jogador, :pontos)
    ON CONFLICT (jogador) DO UPDATE
        SET pontos = EXCLUDED.pontos
        WHERE EXCLUDED.pontos > pontuacao.pontos;
";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':jogador', $jogador, PDO::PARAM_STR);
$stmt->bindValue(':pontos', $pontos, PDO::PARAM_INT);
$stmt->execute();


echo "Pontuação salva: $pontos";
