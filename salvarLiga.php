<?php
require 'connection.php';
session_start();

$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');

if ($nome === '') {
    header("Location: cadastroLigas.php?erro=nome_vazio");
    exit;
}

try {
    $sql = "INSERT INTO liga (nome, descricao) VALUES (:nome, :descricao)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    header("Location: cadastroLigas.php?sucesso=1");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23505") {
        header("Location: cadastroLigas.php?erro=duplicada");
        exit;
    }

    die("Erro ao criar liga: " . $e->getMessage());
}
