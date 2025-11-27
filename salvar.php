<?php
    require 'connection.php';

    $email = $_POST["emailUsuario"];
    $senha = $_POST['senhaUsuario'];

    $sqlCons = "select email from usuario where email = :email";
    $stmtCons = $conn->prepare($sqlCons);
    $stmtCons->bindValue(':email', $email);
    $stmtCons->execute();
    $row = $stmtCons->fetch(PDO::FETCH_ASSOC);
    if($row){
        echo'usuario ' . $row['email'] . ' ja existente'; exit;
    }
    else{

        $sql = "INSERT INTO usuario (email, senha) VALUES (:email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
            header("Location: TelaInicial.php");
            exit;
        } else {
            echo "<p style='color:red;'>Erro ao cadastrar usuário.</p>";
        }
        
    }
?>