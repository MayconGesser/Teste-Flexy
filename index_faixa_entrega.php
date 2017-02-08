<?php

require 'controladorDAOfaixaentrega.php';

$controlador = new ControladorDAOFaixaEntrega;

if(isset($_GET['function'])){
	if($_GET['function'] === 'select'){
		$controlador->listar_todas();
	}
}

else if(isset($_POST['function'])){
	if($_POST['function'] === 'insert'){
		$cep_inicial = trim(strip_tags($_POST['cep_inicial']));
		$cep_final = trim(strip_tags($_POST['cep_final']));
		$peso_minimo = trim(strip_tags($_POST['peso_minimo']));
		$peso_maximo = trim(strip_tags($_POST['peso_maximo']));
		$preco = trim(strip_tags($_POST['preco']));
		$id_transportadora = trim(strip_tags($_POST['id_transportadora']));
		$args = array(
				'cep_inicial' => $cep_inicial,
				'cep_final' => $cep_final,
				'peso_minimo' => $peso_minimo,
				'peso_maximo' => $peso_maximo,
				'preco' => $preco,
				'id_transportadora' => $id_transportadora
			);
		$controlador->insert_faixa_entrega($args);
	}
}

?>