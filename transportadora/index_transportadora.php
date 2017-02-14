<?php

require 'controladorDAOtransportadora.php';

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
		$controlador->insert($args);
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
		$controlador->update($id,$atributos,$valores_novos);
	}
	else if($_POST['function'] === 'delete'){
		$id_transportadora = trim(strip_tags($_POST['id_transportadora']));
		$controlador->delete($id_transportadora);
	}
}
?>