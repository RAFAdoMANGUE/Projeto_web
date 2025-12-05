<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Projeto_final';
$user = 'postgres';
$password = 'admin';

try {
    // Conecta no banco 'postgres' para criar o Projeto_final se não existir
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

    // Conecta no banco Projeto_final
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tabela liga
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

    // Tabela usuario (já com data_entrada_liga)
    $sqlUsuario = "
        CREATE TABLE IF NOT EXISTS usuario (
            id SERIAL PRIMARY KEY,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            id_liga INT NULL,
            nickname VARCHAR(100) NOT NULL UNIQUE,
            data_entrada_liga TIMESTAMP NULL,
            CONSTRAINT fk_usuario_liga
                FOREIGN KEY (id_liga)
                REFERENCES liga(id)
                ON DELETE SET NULL
        );
    ";
    $pdo->exec($sqlUsuario);
    echo "Tabela 'usuario' criada.<br>";

    // Garante que a coluna data_entrada_liga exista
    $sqlCheckDataEntrada = "
        SELECT 1
        FROM information_schema.columns
        WHERE table_name = 'usuario'
          AND column_name = 'data_entrada_liga';
    ";
    $stmtCheckDataEntrada = $pdo->query($sqlCheckDataEntrada);
    $colDataEntradaExiste = $stmtCheckDataEntrada->fetchColumn();

    if (!$colDataEntradaExiste) {
        $sqlAddDataEntrada = "ALTER TABLE usuario ADD COLUMN data_entrada_liga TIMESTAMP NULL;";
        $pdo->exec($sqlAddDataEntrada);
        echo "Coluna 'data_entrada_liga' adicionada à tabela 'usuario'.<br>";
    }

    // Tabela partida
    $sqlPartida = "
        CREATE TABLE IF NOT EXISTS partida (
            id SERIAL PRIMARY KEY,
            id_usuario INT NOT NULL,
            pontos INT NOT NULL,
            tempo_restante INT,
            vidas_restantes INT,
            data_partida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            id_liga INT NULL,
            CONSTRAINT fk_partida_usuario
                FOREIGN KEY (id_usuario)
                REFERENCES usuario(id)
                ON DELETE CASCADE
        );
    ";
    $pdo->exec($sqlPartida);
    echo "Tabela 'partida' criada.<br>";

    // Garante que a coluna id_liga exista em partida
    $sqlCheckCol = "
        SELECT 1
        FROM information_schema.columns
        WHERE table_name = 'partida'
          AND column_name = 'id_liga';
    ";
    $stmtCheckCol = $pdo->query($sqlCheckCol);
    $colExiste = $stmtCheckCol->fetchColumn();

    if (!$colExiste) {
        $sqlAddCol = "ALTER TABLE partida ADD COLUMN id_liga INT NULL;";
        $pdo->exec($sqlAddCol);
        echo "Coluna 'id_liga' adicionada à tabela 'partida'.<br>";
    }

    // Garante que a FK de partida -> liga exista
    $sqlCheckFk = "
        SELECT 1
        FROM information_schema.table_constraints
        WHERE table_name = 'partida'
          AND constraint_type = 'FOREIGN KEY'
          AND constraint_name = 'fk_partida_liga';
    ";
    $stmtCheckFk = $pdo->query($sqlCheckFk);
    $fkExiste = $stmtCheckFk->fetchColumn();

    if (!$fkExiste) {
        $sqlAddFk = "
            ALTER TABLE partida
            ADD CONSTRAINT fk_partida_liga
            FOREIGN KEY (id_liga)
            REFERENCES liga(id)
            ON DELETE SET NULL;
        ";
        $pdo->exec($sqlAddFk);
        echo "Constraint 'fk_partida_liga' criada na tabela 'partida'.<br>";
    }

    // Tabela pontuacao
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

    echo "<br>Banco e tabelas criados/migrados.";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
