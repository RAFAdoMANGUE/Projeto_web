<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = 'login'>
        <h1>Jogo de digitação do Mario</h1>
        <form action="VerificarUsuario.php" method="POST">
        <h2>Faça seu login para jogar<h2>
        <br></br>
        <label>email</label>
        <input type="email" name="emailUsuario">
        <label>senha</label>
        <input type="password" name="senhaUsuario">

        <button type ='submit'>Jogar</button>
        <button type='button' onclick='FuncChamarRegistro()'>registrar</button>
        </div>

        <script>
            function FuncChamarRegistro() {
                window.location.href='indexprojeto.php';
            }
        </script>
</body>
</html>