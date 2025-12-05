<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaInicial.php");
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$idLiga    = isset($_POST['id_liga']) ? (int) $_POST['id_liga'] : 0;

if ($idLiga <= 0) {
    header("Location: tabelaLigas.php");
    exit;
}

// remove o vínculo do usuário com a liga
$sql = "UPDATE usuario SET id_liga = NULL WHERE id = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
$stmt->execute();

header("Location: liga.php?id=" . $idLiga);
exit;
