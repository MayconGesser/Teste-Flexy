<?php

require 'conexao.php';

define('TAB_FAIXA_ENTREGA','faixa_entrega');

$cep_inicial = trim(strip_tags($_POST['CEP_inicial']));
$cep_final = trim(strip_tags($_POST['CEP_final']));
$peso_minimo = trim(strip_tags($_POST['peso_min']));
$peso_maximo = trim(strip_tags($_POST['peso_max']));
$preco = trim(strip_tags($_POST['preco']));

$stmt = $conexao->prepare("INSERT INTO " . TAB_FAIXA_ENTREGA . 
	"(cep_inicial,cep_final,peso_minimo,peso_maximo,preco) VALUES (?,?,?,?,?)");
if(!$stmt){
	die("\nPreparação falhou: (" . $conexao->errno . ") " . $conexao->error);
}
$stmt->bind_param("ssddd",$cep_inicial,$cep_final,$peso_minimo,$peso_maximo,$preco);

if(!$stmt->execute()){
	echo "insert falhou: (" . $stmt->errno . ") " . $stmt->error;
}
else{
	echo "insert executado com sucesso";
}
$stmt->close();
?>