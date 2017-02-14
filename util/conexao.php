<?php
class Conexao{
	private $HOST = 'localhost';
	private $USER = 'root';
	private $SENHA = '';
	private $DB = 'teste_flexy';

	public function getConexao(){
		$retorno = new mysqli($this->HOST,$this->USER,$this->SENHA,$this->DB);
		if(!$retorno){
			die("Conexão falhou: " . $retorno->connect_error);
		}
		return $retorno;
	}
}
?>