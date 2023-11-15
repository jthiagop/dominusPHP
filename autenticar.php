<?php 
	require_once("conexao.php");

    @session_start();

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

//Consultar informações
$query = $pdo->query("SELECT * FROM usuarios  where (email='$usuario' or cpf='$usuario') and senha='$senha' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

if($total_reg > 0) {
    $_SESSION['nome_usuario'] = $res[0]['nome'];
    $_SESSION['email_usuario']= $res[0]['email'];
    $_SESSION['id_usuario'] = $res[0]['id'];
    $_SESSION['telefone_usuario'] = $res[0]['telefone'];
    $_SESSION['nivel_usuario'] = $res[0]['nivel'];
    $_SESSION['cpf_usuario'] = $res[0]['cpf'];

    echo "<script>window.location='painel-admin'</script>";
}else{ 
    echo "<script>window.alert('Dados Incorretos!')</script>";
    echo "<script>window.location='index.php'</script>";
    }

?>