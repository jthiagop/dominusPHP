<?php
require_once('../../conexao.php');
$id = @$_POST['id-excluir'];
$pagina = 'frades';

//excluir a imagem 
$query = $pdo->query("SELECT * FROM $pagina  where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['foto'];
@unlink('../../src/images/membros/' .$foto);

$query = $pdo->query("DELETE FROM $pagina  where id = '$id'");
$query = $pdo->query("DELETE FROM usuarios where id_pessoa = '$id' and nivel = 'bispo'");


echo 'Excluído com Sucesso';
?>