<?php
require_once('../../conexao.php');

$pagina = 'organismos';

$razaosocial = $_POST['razaosocial'];
$cnpj = $_POST['cnpj'];
$data_cnpj = $_POST['data_cnpj'];
$data_fundacao = $_POST['data_fundacao'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data_cad = $_POST['data_cad'];
$matriz = $_POST['matriz'];

$id = @$_POST['id'];


//Verifica se o CPF já foi cadastrado 
$query = $pdo->query("SELECT * FROM $pagina  where cnpj = '$cnpj' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id_reg != $id) {
    echo 'O CNPJ já está cadastrado!';
    exit();
}
//Fim de Verificação


//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../src/images/organismos/' . $nome_img;
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
    $query = $pdo->prepare("INSERT INTO $pagina  SET razaosocial = :razaosocial, 
        cnpj = :cnpj, cidade = :cidade, cep = :cep, rua = :rua, foto = '$imagem', 
        bairro = :bairro, data_cnpj = :data_cnpj, data_fundacao = :data_fundacao, uf = :uf, 
        email = :email, telefone = :telefone, data_cad = curDate(), matriz = 'Filial' ");

    $query->bindValue(":razaosocial", "$razaosocial");
    $query->bindValue(":cnpj", "$cnpj");
    $query->bindValue(":data_cnpj", "$data_cnpj");
    $query->bindValue(":data_fundacao", "$data_fundacao");
    $query->bindValue(":cidade", "$cidade");
    $query->bindValue(":bairro", "$bairro");
    $query->bindValue(":cep", "$cep");
    $query->bindValue(":rua", "$rua");
    $query->bindValue(":uf", "$uf");
    $query->bindValue(":email", "$email");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();

} else {
    if ($imagem == "sem-foto.jpg") {
        $query = $pdo->prepare("UPDATE $pagina  SET razaosocial = :razaosocial, 
        cnpj = :cnpj, cidade = :cidade, cep = :cep, rua = :rua, 
        bairro = :bairro, data_cnpj = :data_cnpj, data_fundacao = :data_fundacao, uf = :uf, 
        email = :email, telefone = :telefone where id = '$id'");
        
    } else {

        $query = $pdo->query("SELECT * FROM $pagina where id = '$id' ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $foto = $res[0]['foto'];
        if ($foto != "sem-foto.jpg") {
            @unlink('../../src/images/organismos/' .$foto);
        }

        $query = $pdo->prepare("UPDATE $pagina SET razaosocial = :razaosocial, 
        cnpj = :cnpj, data_cnpj = :data_cnpj, data_fundacao = :data_fundacao, cidade = :cidade, bairro = :bairro, cep = :cep, rua = :rua, 
        uf = :uf, email = :email, telefone = :telefone, foto = '$imagem' where id = '$id'");
    }

    $query->bindValue(":razaosocial", "$razaosocial");
    $query->bindValue(":cnpj", "$cnpj");
    $query->bindValue(":data_cnpj", "$data_cnpj");
    $query->bindValue(":data_fundacao", "$data_fundacao");
    $query->bindValue(":cidade", "$cidade");
    $query->bindValue(":bairro", "$bairro");
    $query->bindValue(":cep", "$cep");
    $query->bindValue(":rua", "$rua");
    $query->bindValue(":uf", "$uf");
    $query->bindValue(":email", "$email");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();

}

echo 'Salvo com Sucesso';

?>