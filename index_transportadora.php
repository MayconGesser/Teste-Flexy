<?php

require 'controladordaotransportadora.php';

$controlador = new ControladorDAOTransportadora;

if(isset($_GET['function'])){
	if($_GET['function'] === 'select'){
		$controlador->listar_todas();
	}
}

else if(isset($_POST['function'])){
	if($_POST['function'] === 'insert'){
		$nome = ucwords(trim(strip_tags($_POST['nome_transportadora'])));
		$ativa = ucwords(trim(strip_tags($_POST['situacao_transportadora'])));
		$args = array('nome' => $nome, 'ativa' => $ativa);
		$controlador->insert_transportadora($args);
	}
}
?>