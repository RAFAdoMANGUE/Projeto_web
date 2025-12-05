<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    die("Você precisa estar logado para entrar em uma liga.");
}

$idUsuario = (int) $_SESSION['id_usuario'];
$idLiga = isset($_POST['id_liga']) ? (int) $_POST['id_liga'] : 0;

if ($idLiga <= 0) {
    die("Liga inválida.");
}

try {
    $sql = "
        UPDATE usuario
        SET id_liga = :id_liga,
            data_entrada_liga = CURRENT_TIMESTAMP
        WHERE id = :id_usuario
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_liga', $idLiga, PDO::PARAM_INT);
    $stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: liga.php?id=" . $idLiga);
    exit;
} catch (PDOException $e) {
    die("Erro ao entrar na liga: " . $e->getMessage());
}
