<?php

define('HOST','127.0.0.1');
define('USER','root');
define('SENHA','');
define('DB','teste_flexy');

$conexao = new mysqli(HOST,USER,SENHA,DB);
if($conexao->connect_error){	
	die("Conexão falhou.");
}
?>