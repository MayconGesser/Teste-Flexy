<?php
include("conexao.php");

class ControladorDAOTransportadora{
	private $sql_insert = 'INSERT INTO transportadora(nome,ativa) VALUES (?,?)';
	private $sql_select = 'SELECT * FROM transportadora ORDER BY id_transportadora';
	private $conexao;

	public function __construct(){
		$c = new Conexao;
		$this->conexao = $c->getConexao();
	}

	public function __destruct(){
		$this->conexao->close();
	}

	public function insert_transportadora($valores){
		$insert = $this->conexao->prepare($this->sql_insert);
		if(!$insert){
			die("Preparação insert falhou: (" . $this->conexao->errno . ") " . $this->conexao->error);
		}else{
			$nome = $valores['nome'];
			$ativa = $valores['ativa'];
			$insert->bind_param("si",$nome,$ativa);
			if(!$insert->execute()){
				die("insert falhou: (" . $insert->errno . ") " . $insert->error);
			}
			else{
					$insert->close();
					echo "Cadastro executado com sucesso";
				}
			}
	}

	public function listar_todas(){
		$resultado = $this->conexao->query($this->sql_select);
		if($resultado){
			if($resultado->num_rows > 0){
				//monta JSON de retorno
				$retorno = '[';
				$i = 1;
				while($registro = $resultado->fetch_assoc()){
					$json = '{' .  '"id_transportadora" : ' . $registro['id_transportadora'] . ',' . '"nome" : ' . '"' . $registro['nome'] . '"' . 
					',' . '"ativa" : ' . $registro['ativa'] . '}' . 
					($i !== $resultado->num_rows ? ',' : '');	//testa se eh a ultima posicao para por a virgula, para fins de boa construcao do JSON
					$retorno .= $json;
					$i = $i + 1;
				}
				$retorno .= ']';
				echo $retorno;
			} else{
				die('Nenhum resultado');
			}
		}
		else{
			echo "Query falhou";
		}
	}
}

?>