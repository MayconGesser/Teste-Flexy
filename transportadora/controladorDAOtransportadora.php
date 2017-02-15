<?php
include("../util/conexao.php");
require '../util/construirJSON.php';

class ControladorDAOTransportadora{
	private $sql_insert = 'INSERT INTO transportadora(nome,ativa) VALUES (?,?)';
	private $sql_select = 'SELECT * FROM transportadora ORDER BY id_transportadora';
        private $sql_select_fe = 'SELECT * FROM transportadora WHERE ativa = 1 ORDER BY id_transportadora';
        private $atributos = ['id_transportadora','nome','ativa'];
	private $conexao;

	public function __construct(){
		$c = new Conexao;
		$this->conexao = $c->getConexao();
	}

	public function __destruct(){
                try{
                    $this->conexao->close();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }		
	}

	public function insert($valores){
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

	public function update($id,$atributos,$valores_novos){
		$sql_update = 'UPDATE transportadora SET ';
		$i = 0; 
		foreach($atributos as $nome_atributo){
			//recupera o nome dos atributos
			$tipo_atributo = gettype($valores_novos[$nome_atributo]);
			$sql_update .= $nome_atributo . ' = ' . ($tipo_atributo === 'string' ? "'" : '') . $valores_novos[$nome_atributo] . ($tipo_atributo === 'string' ? "'" : '') . ($i !== count($valores_novos)-1 ? ', ' : '');
			$i++;
		}		
		$sql_update .= ' WHERE id_transportadora = ' . $id;
		if(!$this->conexao->query($sql_update)){
			echo 'Erro ao alterar registro: ' . $this->conexao->error;
		}
		else{
			echo 'Alteração realizada com sucesso.';
		}
	}

	public function delete($id){
		$sql_delete = 'DELETE FROM transportadora WHERE id_transportadora = ' . $id;
		if(!$this->conexao->query($sql_delete)){
			echo 'Erro ao remover registro: ' . $this->conexao->error;
		}
		else{
			echo 'Transportadora removida com sucesso';
		}
	}
        
        //o argumento cadastro_faixa_entrega eh usado para determinar se o metodo estah 
        //sendo invocado para realizar a listagem de transportadoras com o fim de 
        //cadastrar uma faixa de entrega; sendo assim, eh desnecessario,
        //e ateh errado, listar transportadoras inativas
	public function listar_todas($cadastro_faixa_entrega){
                $sql_usado = $cadastro_faixa_entrega === 'true'
                        ? $this->sql_select_fe : $this->sql_select;
                $resultado = $this->conexao->query($sql_usado);
		if($resultado){
			if($resultado->num_rows > 0){
				//monta JSON de retorno
				$retorno = '[';
				$i = 1;
				while($registro = $resultado->fetch_assoc()){
					$json = construirJSON($this->atributos,$registro);					
					$retorno .= $json . ($i !== $resultado->num_rows ? ',' : '');	//testa se eh a ultima posicao para por a virgula, para fins de boa construcao do JSON;
					$i++;
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