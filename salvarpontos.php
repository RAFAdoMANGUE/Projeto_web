<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo "Usuário não autenticado.";
    exit;
}

$pontos = isset($_POST['pontos']) ? (int) $_POST['pontos'] : 0;
$tempo_restante = isset($_POST['tempo_restante']) ? (int) $_POST['tempo_restante'] : null;
$vidas_restantes = isset($_POST['vidas_restantes']) ? (int) $_POST['vidas_restantes'] : null;

if ($pontos <= 0) {
    echo "Sem pontos para salvar";
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];

try {
    $conn->beginTransaction();

    // grava histórico da partida
    $sqlPartida = "
        INSERT INTO partida (id_usuario, pontos, tempo_restante, vidas_restantes)
        VALUES (:id_usuario, :pontos, :tempo_restante, :vidas_restantes)
    ";
    $stmtPartida = $conn->prepare($sqlPartida);
    $stmtPartida->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $stmtPartida->bindValue(':pontos', $pontos, PDO::PARAM_INT);
    $stmtPartida->bindValue(':tempo_restante', $tempo_restante, PDO::PARAM_INT);
    $stmtPartida->bindValue(':vidas_restantes', $vidas_restantes, PDO::PARAM_INT);
    $stmtPartida->execute();

    // atualiza melhor pontuação do jogador (ranking geral)
    $sqlPontuacao = "
        INSERT INTO pontuacao (id_usuario, pontos)
        VALUES (:id_usuario, :pontos)
        ON CONFLICT (id_usuario) DO UPDATE
            SET pontos = GREATEST(pontuacao.pontos, EXCLUDED.pontos),
                atualizado_em = CURRENT_TIMESTAMP
    ";
    $stmtPontuacao = $conn->prepare($sqlPontuacao);
    $stmtPontuacao->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $stmtPontuacao->bindValue(':pontos', $pontos, PDO::PARAM_INT);
    $stmtPontuacao->execute();

    $conn->commit();

    echo "Pontuação salva: $pontos";
} catch (PDOException $e) {
    $conn->rollBack();
    http_response_code(500);
    echo "Erro ao salvar pontuação: " . $e->getMessage();
}