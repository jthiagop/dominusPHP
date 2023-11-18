<?php
require_once('../../conexao.php');
$id = @$_POST['id-excluir'];
$pagina = 'tesoureiros';

//excluir a imagem 
$query = $pdo->query("SELECT * FROM $pagina  where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['foto'];
if ($foto != "sem-foto.jpg") {
  @unlink('../../src/images/membros/' . $foto);
}

$query = $pdo->query("DELETE FROM $pagina  where id = '$id'");
$query = $pdo->query("DELETE FROM usuarios where id_pessoa = '$id' and nivel = 'tesoureiros'");


echo 'Excluído com Sucesso';
