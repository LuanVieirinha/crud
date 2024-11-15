<?php
// Inclui o arquivo de conexão com DB
require_once './config.php';

// Busca os dados do formulário
if (isset($_POST['nome'])) {
    cadastrarUsuario();

} else {
    header('location: index.html');
}

function cadastrarUsuario() {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = criptografarSenha($_POST['senha']);
    $idade = $_POST['idade'];

    $connection = abrirConexao();

    // Cria um Statement
    $statement = $connection->prepare("
        INSERT INTO usuario (nome, email, senha, idade)
        VALUES (?, ?, ?, ?);
    ");

    $statement->bind_param('sssi', $nome, $email, $senha, $idade);
    $statement->execute();
    
    // Fecha a conexão
    $connection->close();

    // Mostra os usuários cadastrados
    buscarUsuarios();
}

function buscarUsuarios() {
    $connection = abrirConexao();

    $statement = $connection->prepare("
        SELECT * FROM usuario;
    ");

    $statement->execute();
    $statement->bind_result($id, $nome, $email, $senha, $idade);

    echo "<ul>";

    while ($statement->fetch()) {
        echo "<li>ID: $id, Nome: $nome, E-mail: $email, Senha: $senha, Idade: $idade";
    }

    echo "</ul>";
}

function criptografarSenha($senha) {
    return password_hash($senha, PASSWORD_BCRYPT);
}
