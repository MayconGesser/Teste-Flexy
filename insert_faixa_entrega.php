<?php

require 'conexao.php';

define('TAB_FAIXA_ENTREGA','faixa_entrega');

$id_transportadora = trim(strip_tags($_POST['id_transportadora']));
$cep_inicial = trim(strip_tags($_POST['CEP_inicial']));
$cep_final = trim(strip_tags($_POST['CEP_final']));
$peso_minimo = trim(strip_tags($_POST['peso_min']));
$peso_maximo = trim(strip_tags($_POST['peso_max']));
$preco = trim(strip_tags($_POST['preco']));

$stmt = $conexao->prepare("INSERT INTO " . TAB_FAIXA_ENTREGA . 
	"(cep_inicial,cep_final,peso_minimo,peso_maximo,preco,id_transportadora) VALUES (?,?,?,?,?,?)");
if(!$stmt){
	die("\nPreparação falhou: (" . $conexao->errno . ") " . $conexao->error);
}
$stmt->bind_param("ssdddi",$cep_inicial,$cep_final,$peso_minimo,$peso_maximo,$preco,$id_transportadora);

if(!$stmt->execute()){
	echo "insert falhou: (" . $stmt->errno . ") " . $stmt->error;
}
else{
	echo "insert executado com sucesso";
}
$stmt->close();
?>