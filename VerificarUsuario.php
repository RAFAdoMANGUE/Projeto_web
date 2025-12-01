<?php
require 'connection.php';

    $jogarEmail = $_POST['emailUsuario'];
    $jogarSenha = $_POST['senhaUsuario'];

    $sqlConsJogar = 'select email from usuario where email = :email AND senha= :senha';

    $stmtConsJogar = $conn ->prepare($sqlConsJogar);
    $stmtConsJogar->bindValue(':email', $jogarEmail);
    $stmtConsJogar->bindValue(':senha', $jogarSenha);
    $stmtConsJogar->execute();
    $user= $stmtConsJogar->fetch(PDO::FETCH_ASSOC);
    if($user){
         header("Location: index.html");
         exit;
    } 
    else{
        echo'login invalido';
    }