<?php

function abrirConexao() {
    // Configuração do Banco de Dados
    $host = 'localhost';
    $user = 'root';
    $pass = 'usbw';
    $dbname = 'crud';

    // Cria a conexão com a DB
    $connection = new mysqli($host, $user, $pass, $dbname);

    // Verifica a conexão
    if ($connection->connect_error) {
        die("Conexão falhou");
    }

    return $connection;
}
