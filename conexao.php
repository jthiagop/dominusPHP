<?php

$DB_NAME = "dominus1";
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_HOST = "localhost";

date_default_timezone_set('America/Sao_Paulo');

$email_super_adm = "jthiagopereira@gmail.com";
$nome_organismo = "PRONEB - Província Nossa Senhora da Penha do Nordeste do Brasil";

$razaosocial = "PROVINCIA NOSSA SENHORA DA PENHA DO NORDESTE DO BRASIL";
$cnpj = "11.021.607/0001-74";
$data_cnpj = "2005/10/22";
$data_fundacao = "1970/10/22";
$cep = "50020-280";
$rua = "Praca Dom Vital, 169";
$bairro = "São José";
$cidade = "Recife";
$uf = "PE";
$email = "secretario@proneb.com.br";
$telefone = "(00) 00000-0000";


try {
    $pdo = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", "$DB_USER", "$DB_PASSWORD");
} catch (Exception $err) {
    echo 'Erro ao Conectar ao Banco de Dados', $err;
};

//INSERIR REGISTROS INICIAIS 
// Criar um bispo (administrador) padrão. 

//Consultar informações
$query = $pdo->query("SELECT * FROM bispos ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

//INSERIR REGISTROS INICIAIS 
if ($total_reg == 0) {
    $pdo->query(
        "INSERT INTO bispos SET nome = 'Super Administrador', email = '$email_super_adm', 
        cpf = '109.824.874-01', telefone = '(87) 9.9977-1225', foto = 'sem-foto.jpg' "
    );
}


//Consultar informações
$query = $pdo->query("SELECT * FROM usuarios ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

//INSERIR REGISTROS INICIAIS 
if ($total_reg == 0) {
    $pdo->query(
        "INSERT INTO usuarios SET nome = 'Super Administrador', email = '$email_super_adm', 
        senha = '1234', cpf = '109.824.874-01', nivel = 'bispo', id_pessoa = 1, foto = 'sem-foto.jpg' "
    );
}

//criar o organismo matriz
$query = $pdo->query("SELECT * FROM organismos ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

//INSERIR REGISTROS INICIAIS 
if ($total_reg == 0) {
    $pdo->query(
        "INSERT INTO organismos SET razaosocial = '$razaosocial', cnpj = '$cnpj',
        data_cnpj = '$data_cnpj', data_fundacao = '$data_fundacao', cep = '$cep', 
        rua = '$rua', bairro = '$bairro', cidade = '$cidade',
        uf = '$uf', email = '$email', telefone = '$telefone', foto = 'sem-foto.jpg',
        data_cad = curDate(), matriz = 'Matriz' "
    );
}



// Criar uma configuração padram. 

$query = $pdo->query("SELECT * FROM config ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

if ($total_reg == 0) {
    $pdo->query("INSERT INTO config SET nome = 'email_super_adm', valor = '$email_super_adm' ");
    $pdo->query("INSERT INTO config SET nome = 'nome_organismo', valor = '$nome_organismo' ");
    $pdo->query("INSERT INTO config SET nome = 'endereco_organismo', valor = '$rua' ");
    $pdo->query("INSERT INTO config SET nome = 'email_organismo', valor = '$email' ");
}

//BUSCAR INFORMAÇÕES DE CONFIGURAÇÕES NO BANCO 
$query = $pdo->query("SELECT * FROM config where nome = 'email_super_adm'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_super_adm = $res[0]['valor'];

$query = $pdo->query("SELECT * FROM config where nome = 'nome_organismo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_organismo = $res[0]['valor'];
