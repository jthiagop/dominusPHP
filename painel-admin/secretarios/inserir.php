<?php
require_once('../../conexao.php');

$pagina = 'secretarios';

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$id = @$_POST['id'];
$id_organismo = @$_POST['id_organismo'];

if($id_organismo == ""){
    $id_organismo = 1;
}

//Verifica se o CPF já foi cadastrado 

$query = $pdo->query("SELECT * FROM $pagina  where cpf = '$cpf' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id_reg != $id) {
    echo 'O CPF já está cadastrado!';
    exit();
}
//Fim de Verificação

//Verifica se o email já foi cadastrado 
$query = $pdo->query("SELECT * FROM $pagina   where email = '$email' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id_reg != $id) {
    echo 'O Email já está cadastrado!';
    exit();
}
//Fim de Verificação


//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../src/images/membros/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
    $imagem = "sem-foto.jpg";
} else {
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
    move_uploaded_file($imagem_temp, $caminho);
} else {
    echo 'Extensão de Imagem não permitida!';
    exit();
}



if ($id == '' || $id == 0) {
    $query = $pdo->prepare("INSERT INTO $pagina  SET nome = :nome, email = :email, 
        cpf = :cpf, endereco = :endereco, telefone = :telefone, foto = '$imagem',
        data_nasc = '$data_nasc', data_cad = curDate(), organismo = '$id_organismo' ");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->bindValue(":endereco", "$endereco");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();
    $ult_id = $pdo->lastInsertId();

    $query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, 
        cpf = :cpf, senha = '$cpf', nivel = 'secretarios', id_pessoa = '$ult_id', foto = '$imagem'  ");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->execute();

} else {
    if ($imagem == "sem-foto.jpg") {
        $query = $pdo->prepare("UPDATE $pagina  SET nome = :nome, email = :email, 
        cpf = :cpf, endereco = :endereco, telefone = :telefone, 
        data_nasc = '$data_nasc' where id = '$id'");
    } else {
        $query = $pdo->query("SELECT * FROM $pagina  where id = '$id' ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $foto = $res[0]['foto'];
        if ($foto != "sem-foto.jpg") {
            @unlink('../../src/images/membros/' . $foto);
        }

        $query = $pdo->prepare("UPDATE $pagina  SET nome = :nome, email = :email, 
        cpf = :cpf, endereco = :endereco, telefone = :telefone, foto = '$imagem',
        data_nasc = '$data_nasc' where id = '$id'");
    }

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->bindValue(":endereco", "$endereco");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();

    if ($imagem == "sem-foto.jpg") {
        $query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, 
        cpf = :cpf where id_pessoa = '$id' and nivel = 'secretarios'");
    } else {
        $query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, 
        cpf = :cpf, foto = '$imagem' where id_pessoa = '$id' and nivel = 'secretarios'");
    }
    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":cpf", "$cpf");
    $query->execute();
}

echo 'Salvo com Sucesso';
