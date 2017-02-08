<?
include("conexao.php");

class ControladorDAOFaixaEntrega{
	private $sql_insert = "INSERT INTO faixa_entrega(cep_inicial,cep_final,peso_minimo,peso_maximo,preco,id_transportadora) VALUES (?,?,?,?,?,?)";

	private $sql_select = "SELECT f.*,t.nome AS nome_transportadora FROM faixa_entrega AS f
						   INNER JOIN transportadora AS t ON f.id_transportadora = t.id_transportadora
						   ORDER BY f.id_faixa_entrega, t.nome";
	private $conexao; 

	public function __construct(){
		$c = new Conexao;
		$this->conexao = $c->getConexao();
	}

	public function __destruct(){
		$this->conexao->close();
	}

	public function insert_faixa_entrega($valores){
		$insert = $this->conexao->prepare($this->sql_insert);
		if(!$insert){
			die("Preparação insert falhou: (" . $this->conexao->errno . ") " . $this->conexao->error);
		}else{
			$cep_inicial = $valores['cep_inicial'];
			$cep_final = $valores['cep_final'];
			$peso_minimo = $valores['peso_minimo'];
			$peso_maximo = $valores['peso_maximo'];
			$preco = $valores['preco'];
			$id_transportadora = $valores['id_transportadora'];

			$insert->bind_param(
				"ssdddi",$cep_inicial,$cep_final,$peso_minimo,$peso_maximo,$preco,$id_transportadora
			);

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
					$json = '{' .  '"cep_inicial" : ' . $registro['cep_inicial'] . ',' .
					'"cep_final" : ' . '"' . $registro['cep_final'] . '"' . ',' . 
					'"peso_minimo" : ' . $registro['peso_minimo'] . ',' . 
					'"peso_maximo" : ' . $registro['peso_maximo'] . ',' .
					'"preco" : ' . $registro['preco'] . ',' . 
					'"nome_transportadora" : ' . '"' . $registro['nome_transportadora'] . '"' .
					'}' . 
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