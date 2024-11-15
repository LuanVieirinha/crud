<?php
// Busca os dados do formulário
if (isset($_POST['nome'])) {
    cadastrarUsuario();

} else {
    header('location: index.html');
}

function cadastrarUsuario() {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $idade = $_POST['idade'];

    // Configurar o Banco de Dados
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

    // Cria um Statement
    $statement = $connection->prepare("
        INSERT INTO usuario (nome, email, senha, idade)
        VALUES (?, ?, ?, ?);
    ");

    $statement->bind_param('sssi', $nome, $email, $senha, $idade);
    $statement->execute();
}
