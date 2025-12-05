<?php
session_start();
require 'connection.php';

$jogarEmail = $_POST['emailUsuario'];
$jogarSenha = $_POST['senhaUsuario'];

if ($jogarEmail === '' || $jogarSenha === '') {
    header("Location: TelaInicial.php?erro=1");
    exit;
}

$sqlConsJogar = '
    SELECT id, email, nickname 
    FROM usuario 
    WHERE email = :email 
      AND senha = :senha
';

$stmt = $conn->prepare($sqlConsJogar);
$stmt->bindValue(':email', $jogarEmail);
$stmt->bindValue(':senha', $jogarSenha);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {

    $nickname = $user['nickname'];
    setcookie("jogador", $nickname, time() + 3600, "/");
    $_SESSION['id_usuario'] = $user['id'];
    header("Location: home.php");
    exit;
}
else {
    header("Location: TelaInicial.php?erro=1")
    exit;
}
