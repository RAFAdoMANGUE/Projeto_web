<?php
session_start();
require 'connection.php';

// usuário precisa estar logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaInicial.php");
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$idLiga    = isset($_POST['id_liga']) ? (int) $_POST['id_liga'] : 0;

if ($idLiga <= 0) {
    // id inválido, volta pra lista de ligas
    header("Location: tabelaLigas.php");
    exit;
}

// Atualiza o usuário para entrar na liga
$sql = "UPDATE usuario SET id_liga = :id_liga WHERE id = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_liga', $idLiga, PDO::PARAM_INT);
$stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
$stmt->execute();

// Volta para a página da liga
header("Location: liga.php?id=" . $idLiga);
exit;
