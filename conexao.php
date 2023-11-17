<?php

$DB_NAME = "dominus1";
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_HOST = "localhost";

date_default_timezone_set('America/Sao_Paulo');

$email_super_adm = "jthiagopereira@gmail.com";
$nome_organismo = "PRONEB - Província Nossa Senhora da Penha do Nordeste do Brasil";

try{
    $pdo = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", "$DB_USER","$DB_PASSWORD");
}catch(Exception $err){
    echo 'Erro ao Conectar ao Banco de Dados', $err;
};

//INSERIR REGISTROS INICIAIS 
// Criar um bispo (administrador) padrão. 

//Consultar informações
$query = $pdo->query("SELECT * FROM bispos ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res); 

//INSERIR REGISTROS INICIAIS 
if($total_reg == 0) {
    $pdo->query("INSERT INTO bispos SET nome = 'Super Administrador', email = '$email_super_adm', 
        cpf = '109.824.874-01', telefone = '(87) 9.9977-1225', foto = 'sem-foto.jpg' "
    );}


    //Consultar informações
$query = $pdo->query("SELECT * FROM usuarios ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res); 

//INSERIR REGISTROS INICIAIS 
if($total_reg == 0) {
    $pdo->query("INSERT INTO usuarios SET nome = 'Super Administrador', email = '$email_super_adm', 
        senha = '1234', cpf = '109.824.874-01', nivel = 'bispo', id_pessoa = 1, foto = 'sem-foto.jpg' "
    );}

// Criar uma configuração padram. 

$query = $pdo->query("SELECT * FROM config ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

if($total_reg == 0) {
    $pdo->query("INSERT INTO config SET nome = 'email_super_adm', valor = '$email_super_adm' ");
    $pdo->query("INSERT INTO config SET nome = 'nome_organismo', valor = '$nome_organismo' ");
}

//BUSCAR INFORMAÇÕES DE CONFIGURAÇÕES NO BANCO 
$query = $pdo->query("SELECT * FROM config where nome = 'email_super_adm'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_super_adm = $res[0]['valor'];

$query = $pdo->query("SELECT * FROM config where nome = 'nome_organismo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_organismo = $res[0]['valor'];

?>