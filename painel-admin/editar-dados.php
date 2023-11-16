<?php
    require_once('../conexao.php');

    $nome = $_POST['nome_usu'];
    $cpf = $_POST['cpf_usu'];
    $email = $_POST['email_usu'];
    $senha = $_POST['senha_usu'];
    $id = $_POST['id_usu'];

    $query = $pdo->query("SELECT * FROM usuarios where id = $id");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $cpf_antigo = $res[0]['cpf'];
    $email_antigo = $res[0]['email'];
    $nivel_usu = $res[0]['nivel'];
    $id_pessoa = $res[0]['id_pessoa'];

    //Verifica se o CPF já foi cadastrado 
    if($cpf_antigo != $cpf) {
        $query = $pdo->query("SELECT * FROM usuarios  where cpf = '$cpf' ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res) > 0 ){
            echo 'O CPF já está cadastrado!';
            exit();
        }
    }
    //Fim de Verificação

    //Verifica se o email já foi cadastrado 
    if($email_antigo != $email) {
        $query = $pdo->query("SELECT * FROM usuarios  where email = '$email' ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res) > 0 ){
            echo 'O Email já está cadastrado!';
            exit();
        }
    }
    //Fim de Verificação

$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha where id = '$id'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":senha", "$senha");
$query->execute();

if($nivel_usu == 'bispo'){
	$query2 = $pdo->prepare("UPDATE bispos SET nome = :nome, email = :email, cpf = :cpf where id = '$id_pessoa'");
}

$query2->bindValue(":nome", "$nome");
$query2->bindValue(":email", "$email");
$query2->bindValue(":cpf", "$cpf");
$query2->execute();

if($query2->rowCount() > 0){
	$query->execute();
	echo 'Salvo com Sucesso';
}else{
	echo 'Deu Erro, não possível atualizar o registro, tente novamente!';
}
?>