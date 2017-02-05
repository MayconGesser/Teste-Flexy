<?php

require 'conexao.php';

//usa-se uma constante para se referir a tabela por questao de flexibilidade e boa pratica
//de nao usar o nome da tabela de maneira "hard-coded"; eh possivel q a tabela seja renomeada,
//oq ocasionaria uma troca manual de nome em cada pedaco de codigo q a referencia de maneira 
//hard-coded, ao passo q o uso de uma constante permite simplesmente trocar seu valor
define('TAB_TRANSPORTADORA','transportadora');

//sanitiza inputs
$nome = ucwords(trim(strip_tags($_POST['nome_transportadora'])));
$ativa = ucwords(trim(strip_tags($_POST['situacao_transportadora'])));
$stmt = $conexao->prepare("INSERT INTO " . TAB_TRANSPORTADORA . "(nome,ativa) VALUES(?,?)");
if(!$stmt){
	die("\nPreparação falhou: (" . $conexao->errno . ") " . $conexao->error);
}
$stmt->bind_param("si",$nome,$ativa);
if(!$stmt->execute()){
	echo "insert falhou: (" . $stmt->errno . ") " . $stmt->error;
}
else{
	echo "insert executado com sucesso";
}
$stmt->close();
?>