<?php
include("conexao.php");

class ControladorDAOTransportadora{
	private $sql_insert = 'INSERT INTO transportadora(nome,ativa) VALUES (?,?)';
	private $sql_select = 'SELECT * FROM transportadora ORDER BY id_transportadora';
	private $conexao;
	private $insert;
	private $select;

	public function __construct(){
		$c = new Conexao;
		$this->conexao = $c->getConexao();
	}

	public function insert_transportadora($valores){
		if(!$this->insert){
			$this->insert = $this->conexao->prepare($this->sql_insert);
			if(!$this->insert){
				die("Preparação falhou: (" . $this->conexao->errno . ") " . $this->conexao->error);
			}else{
				$nome = $valores['nome'];
				$ativa = $valores['ativa'];
				$this->insert->bind_param("si",$nome,$ativa);
				if(!$this->insert->execute()){
					die("insert falhou: (" . $this->insert->errno . ") " . $this->insert->error);
				}
				else{
					echo "insert executado com sucesso";
					$this->insert->close();
				}
			}
		}
	}
}

?>