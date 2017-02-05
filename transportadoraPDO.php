<?php
header("Content-Type: application/json");
require 'conexao.php';

define('TAB_TRANSPORTADORA','transportadora');

$sql = "SELECT * FROM " . TAB_TRANSPORTADORA . " ORDER BY id_transportadora";
$resultado = $conexao->query($sql);
if($resultado){
	if($resultado->num_rows > 0){
		$retorno = '[';
		$i = 1;
		while($registro = $resultado->fetch_assoc()){
			$json = '{' .  '"id_transportadora" : ' . $registro['id_transportadora'] . ',' . '"nome" : ' . '"' . $registro['nome'] . '"' . '}' . 
			($i !== $resultado->num_rows ? ',' : '');
			$retorno .= $json;
			$i = $i + 1;
		}
		$retorno .= ']';
		echo json_encode($retorno);
	} else{
		echo 'Nenhum resultado';
	}
}
else{
	echo "Query falhou";
}
$conexao->close();
?>