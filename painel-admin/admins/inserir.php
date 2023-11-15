<?php
require_once('../../conexao.php');

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$id = @$_POST['id'];


//Verifica se o CPF já foi cadastrado 

$query = $pdo->query("SELECT * FROM bispos where cpf = '$cpf' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id_reg != $id) {
    echo 'O CPF já está cadastrado!';
    exit();
}
//Fim de Verificação

//Verifica se o email já foi cadastrado 
$query = $pdo->query("SELECT * FROM bispos  where email = '$email' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id_reg != $id) {
    echo 'O Email já está cadastrado!';
    exit();
}
//Fim de Verificação


if ($id == '' || $id == 0) {
    $query = $pdo->prepare("INSERT INTO bispos SET nome = :nome, email = :email, 
        cpf = :cpf, endereco = :endereco, telefone = :telefone ");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->bindValue(":endereco", "$endereco");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();
    $ult_id = $pdo->lastInsertId();

    $query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, 
        cpf = :cpf, senha = '$cpf', nivel = 'bispo', id_pessoa = '$ult_id' ");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->execute();
} else {
    $query = $pdo->prepare("UPDATE bispos SET nome = :nome, email = :email, 
        cpf = :cpf, endereco = :endereco, telefone = :telefone where id = '$id'");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->bindValue(":endereco", "$endereco");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();

    $query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, 
        cpf = :cpf where id_pessoa = '$id' and nivel = 'bispo'");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->execute();
}

echo 'Salvo com Sucesso';
