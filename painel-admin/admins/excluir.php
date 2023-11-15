<?php
require_once('../../conexao.php');
$id = @$_POST['id-excluir'];

$query = $pdo->query("DELETE FROM bispos where id = '$id'");
$query = $pdo->query("DELETE FROM usuarios where id_pessoa = '$id' and nivel = 'bispo'");


echo 'Excluído com Sucesso';
?>