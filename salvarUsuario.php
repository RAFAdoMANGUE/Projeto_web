<?php
require 'connection.php';

// lê os dados enviados pelo formulário
$email    = $_POST["emailUsuario"] ?? '';
$senha    = $_POST['senhaUsuario'] ?? '';
$nickname = $_POST['nickname']     ?? '';

$email    = trim($email);
$senha    = trim($senha);
$nickname = trim($nickname);

if ($email === '' || $senha === '' || $nickname === '') {
    header("Location: cadastroUsuario.php?erro=campos_vazios");
    exit;
}

// verificar se já existe usuário com esse email OU esse nickname
$sqlCons = "
    SELECT email, nickname 
    FROM usuario 
    WHERE email = :email OR nickname = :nickname
";
$stmtCons = $conn->prepare($sqlCons);
$stmtCons->bindValue(':email', $email);
$stmtCons->bindValue(':nickname', $nickname);
$stmtCons->execute();

$usuarioExistente = $stmtCons->fetch(PDO::FETCH_ASSOC);

if ($usuarioExistente) {

    if ($usuarioExistente['email'] === $email) {
        header("Location: cadastroUsuario.php?erro=email");
        exit;
    }

    if ($usuarioExistente['nickname'] === $nickname) {
        header("Location: cadastroUsuario.php?erro=nickname");
        exit;
    }
}

// insere usuário
$sql = "INSERT INTO usuario (email, senha, nickname) 
        VALUES (:email, :senha, :nickname)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha); 
$stmt->bindParam(':nickname', $nickname);

if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro realizado</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="caixacadastro">
            <h1>Usuário cadastrado com sucesso!</h1>
            <p>Seu cadastro foi realizado. Clique no botão abaixo para ir para a tela de login.</p>

            <form action="TelaInicial.php" method="get">
                <button type="submit" class="botao">Ir para login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
} else {
    header("Location: cadastroUsuario.php?erro=desconhecido");
    exit;
}
