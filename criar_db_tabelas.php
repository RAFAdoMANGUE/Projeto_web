<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Projeto_final';
$user = 'postgres';
$password = 'admin';

try {
    $pdoAdmin = new PDO("pgsql:host=$host;port=$port;dbname=postgres;", $user, $password);
    $pdoAdmin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $sqlCreateDb = 'CREATE DATABASE "Projeto_final"';
        $pdoAdmin->exec($sqlCreateDb);
        echo "Banco Projeto_final criado.<br>";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'already exists') !== false) {
            echo "Banco Projeto_final já existe.<br>";
        } else {
            throw $e;
        }
    }

    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlLiga = "
        CREATE TABLE IF NOT EXISTS liga (
            id SERIAL PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            descricao TEXT,
            criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";
    $pdo->exec($sqlLiga);
    echo "Tabela 'liga' criada.<br>";

    $sqlUsuario = "
        CREATE TABLE IF NOT EXISTS usuario (
            id SERIAL PRIMARY KEY,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            id_liga INT NULL,
            nickname VARCHAR(100) NOT NULL UNIQUE,
            CONSTRAINT fk_usuario_liga
                FOREIGN KEY (id_liga)
                REFERENCES liga(id)
                ON DELETE SET NULL
        );
    ";
    $pdo->exec($sqlUsuario);
    echo "Tabela 'usuario' criada.<br>";

    $sqlPartida = "
        CREATE TABLE IF NOT EXISTS partida (
            id SERIAL PRIMARY KEY,
            id_usuario INT NOT NULL,
            pontos INT NOT NULL,
            tempo_restante INT,
            vidas_restantes INT,
            data_partida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT fk_partida_usuario
                FOREIGN KEY (id_usuario)
                REFERENCES usuario(id)
                ON DELETE CASCADE
        );
    ";

    $sqlPontuacao = "
    CREATE TABLE IF NOT EXISTS pontuacao (
        id SERIAL PRIMARY KEY,
        id_usuario INT NOT NULL UNIQUE,
        pontos INT NOT NULL DEFAULT 0,
        atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_pontuacao_usuario
            FOREIGN KEY (id_usuario)
            REFERENCES usuario(id)
            ON DELETE CASCADE
    );
";
$pdo->exec($sqlPontuacao);
echo "Tabela 'pontuacao' criada.<br>";

    $pdo->exec($sqlPartida);
    echo "Tabela 'partida' criada.<br>";

    echo "<br>Banco e tabelas criados.";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
