<?php

require 'controladordaotransportadora.php';

$controlador = new ControladorDAOTransportadora;
$nome = ucwords(trim(strip_tags($_POST['nome_transportadora'])));
$ativa = ucwords(trim(strip_tags($_POST['situacao_transportadora'])));
$args = array('nome' => $nome, 'ativa' => $ativa);
$controlador->insert_transportadora($args);

?>