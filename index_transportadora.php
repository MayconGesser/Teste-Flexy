<?php

require 'controladordaotransportadora.php';

$controlador = new ControladorDAOTransportadora;

if(isset($_GET['function'])){
	if($_GET['function'] === 'select'){
		$controlador->listar_todas();
	}
	else if($_GET['function'] === 'get'){
		$id_transportadora = $_GET['id_transportadora'];
		$controlador->get_registro($id_transportadora);
	}
}

else if(isset($_POST['function'])){
	if($_POST['function'] === 'insert'){
		$nome = ucwords(trim(strip_tags($_POST['nome_transportadora'])));
		$ativa = ucwords(trim(strip_tags($_POST['situacao_transportadora'])));
		$args = array('nome' => $nome, 'ativa' => $ativa);
		$controlador->insert_transportadora($args);
	}
	else if($_POST['function'] === 'update'){
		$atributos = array();
		$valores_novos = array();
		$id = trim(strip_tags($_POST['id_transportadora']));
		if(isset($_POST['nome'])){
			$nome = ucwords(trim(strip_tags($_POST['nome'])));
			array_push($atributos,'nome');
			$valores_novos['nome'] = $nome;
		}
		if(isset($_POST['ativa'])){
			$ativa = trim(strip_tags($_POST['ativa']));
			array_push($atributos,'ativa');
			$valores_novos['ativa'] = $ativa;
		}
		$controlador->update_transportadora($id,$atributos,$valores_novos);
	}
}
?>