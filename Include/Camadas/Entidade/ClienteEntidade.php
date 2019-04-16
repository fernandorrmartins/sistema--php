<?php
	/**
	 * Classe Cliente é responsável por representar os Cliente
	 * Possui todos atributos da tabela Cliente e seus respectivos métodos
	 */
	class ClienteEntidade {
		/**
		 * Atributos da Classe ClienteEntidade
		 */
		public $Identificador;
		public $CodigoCliente;
		public $Nome;
		public $Celular;
		public $Email;
		public $Rua;
		public $Numero;
		public $Bairro;
		public $Cidade;
		public $Cep;
		public $Estado;
		public $TipoCliente;
		public $Setor;
		public $Curso;

		// Objeto responsável pelo retorno de erros ao usuário
		public $Erro;

		/**
		 * Método Construtor da Classe
		 */
		function __construct() {
			$this->TipoCliente = array(0, 'Desc' => NULL);
			$this->Setor = new SetorEntidade();
			$this->Curso = new CursoEntidade();
			$this->Erro = new ErroProjecao();
		}

		public static function excluirCliente($idCliente){
			try {
				$PDO = db_connect();
				$query = " DELETE FROM cliente ";
				$query .= " WHERE Identificador = " . $idCliente . "; ";
				$stmt = $PDO->prepare($query);
				$deletou = $stmt->execute();

				return $deletou;
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo(1);
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function inserirCliente($dados){
			try {
				$PDO = db_connect();
				$query = " INSERT INTO cliente(CodigoCliente, Nome, Celular, Email, Rua, Numero, Bairro, Cidade, Cep, Estado, TipoCliente, Setor, Curso) VALUES('$dados->CodigoCliente', '$dados->Nome', '$dados->Celular', '$dados->Email', '$dados->Rua', '$dados->Numero', '$dados->Bairro', '$dados->Cidade', '$dados->Cep', '$dados->Estado', '$dados->TipoCliente', '$dados->Setor', '$dados->Curso'); ";
				$stmt = $PDO->prepare($query);
				$inseriu = $stmt->execute();

				return $inseriu;
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo(1);
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function atualizarClienteSolicitacao($dados){
			try {
				$PDO = db_connect();
				$query = " UPDATE cliente SET ";
				$query .= " Nome = '" . $dados->Nome . "', ";
				$query .= " Celular = '" . $dados->Celular . "', ";
				$query .= " Email = '" . $dados->Email . "', ";
				$query .= " Rua = '" . $dados->Rua . "', ";
				$query .= " Numero = " . $dados->Numero . ", ";
				$query .= " Bairro = '" . $dados->Bairro . "', ";
				$query .= " Cidade = '" . $dados->Cidade . "', ";
				$query .= " Cep = '" . $dados->Cep . "', ";
				$query .= " Estado = '" . $dados->Estado . "', ";
				$query .= " TipoCliente = " . $dados->TipoCliente . ", ";
				$query .= " Setor = " . $dados->Setor . ", ";
				$query .= " Curso = " . $dados->Curso . " ";
				$query .= " WHERE CodigoCliente = '" . $dados->CodigoCliente . "'; ";
				$stmt = $PDO->prepare($query);
				$atualizou = $stmt->execute();

				return $atualizou;
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo(1);
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function buscarCliente($dados){
			try {
				$PDO = db_connect();
				$query = " SELECT * FROM cliente WHERE
				CodigoCliente = '" . $dados->CodigoCliente . "' AND " .
				" Nome = '" . $dados->Nome . "' AND " .
				" Celular = '" . $dados->Celular . "' AND " .
				" Email = '" . $dados->Email . "' AND " .
				" Rua = '" . $dados->Rua . "' AND " .
				" Numero = " . $dados->Numero . " AND " .
				" Bairro = '" . $dados->Bairro . "' AND " .
				" Cidade = '" . $dados->Cidade . "' AND ".
				" Cep = '" . $dados->Cep . "' AND ".
				" Estado = '" . $dados->Estado . "' AND ".
				" TipoCliente = " . $dados->TipoCliente . " AND ".
				" Setor = " . $dados->Setor . " AND ".
				" Curso = " . $dados->Curso . "; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$cliente = $stmt->fetch(PDO::FETCH_OBJ);

				return $cliente;
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo(1);
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function recuperarClientePelaSolicitacao($idSolicitacao){
			try {
				$PDO = db_connect();
				$query = " SELECT c.* FROM cliente c inner join solicitacao s on s.Cliente = c.Identificador WHERE  s.Identificador = " . $idSolicitacao . " LIMIT 1; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$cliente = $stmt->fetch(PDO::FETCH_OBJ);

				$cliente = ClienteEntidade::preencherCliente($cliente);

				return $cliente;
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo(1);
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function recuperarClientePeloCodigo($CodigoCliente) {
			try {
				if(Util::varificarSqlInjection($CodigoCliente)) {
					throw new  Exception("Entrada de caracter não permitida!", 1);
				} else {
					$PDO = db_connect();
					$query = " SELECT * FROM cliente WHERE CodigoCliente = '" . $CodigoCliente . "'; ";
					$stmt = $PDO->prepare($query);
					$stmt->execute();
					$cliente = $stmt->fetch(PDO::FETCH_OBJ);

					if ($cliente)
						$cliente = ClienteEntidade::preencherCliente($cliente);
					else {
						throw new Exception("Não há usuário com esse código!", 1);
					}
						

					return $cliente;
				}
			} catch (Exception $e) {
				$cliente = new ClienteEntidade();

				$cliente->Erro->setCodigo($e->getCode());
				$cliente->Erro->setMensagem($e->getMessage());

				return $cliente;
			}
		}

		public static function preencherCliente($dados) {
			if(is_string($dados))
				$dados = Util::convertJsonEmObjeto($dados);

			$cliente = new ClienteEntidade();

			$cliente->setIdentificador($dados->Identificador);
			$cliente->setCodigoCliente($dados->CodigoCliente);
			$cliente->setNome($dados->Nome);
			$cliente->setCelular($dados->Celular);
			$cliente->setEmail($dados->Email);
			$cliente->setRua($dados->Rua);
			$cliente->setNumero($dados->Numero);
			$cliente->setBairro($dados->Bairro);
			$cliente->setCidade($dados->Cidade);
			$cliente->setCep($dados->Cep);
			$cliente->setEstado($dados->Estado);
			$cliente->setTipoCliente($dados->TipoCliente);
			$cliente->setSetor($dados->Setor);
			$cliente->setCurso($dados->Curso);

			if(isset($dados->Erro) and !empty($dados->Erro)){
				$cliente->Erro->setCodigo($dados->Erro->Codigo);
				$cliente->Erro->setMensagem($dados->Erro->Mensagem);
			}

			return $cliente;
		}

		public function recuperarJson(){
			return json_encode($this);
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setIdentificador($Identificador) { $this->Identificador = $Identificador; }
		public function getIdentificador() { return $this->Identificador; }

		public function setCodigoCliente($CodigoCliente) { $this->CodigoCliente = $CodigoCliente; }
		public function getCodigoCliente() { return $this->CodigoCliente; }

		public function setNome($Nome) { $this->Nome = $Nome; }
		public function getNome() { return $this->Nome; }

		public function setCelular($Celular) { $this->Celular = $Celular; }
		public function getCelular() { return $this->Celular; }

		public function setEmail($Email) { $this->Email = $Email; }
		public function getEmail() { return $this->Email; }

		public function setRua($Rua) { $this->Rua = $Rua; }
		public function getRua() { return $this->Rua; }

		public function setNumero($Numero) { $this->Numero = $Numero; }
		public function getNumero() { return $this->Numero; }

		public function setBairro($Bairro) { $this->Bairro = $Bairro; }
		public function getBairro() { return $this->Bairro; }

		public function setCidade($Cidade) { $this->Cidade = $Cidade; }
		public function getCidade() { return $this->Cidade; }

		public function setCep($Cep) { $this->Cep = $Cep; }
		public function getCep() { return $this->Cep; }

		public function setEstado($Estado) { $this->Estado = $Estado; }
		public function getEstado() { return $this->Estado; }

		public function setTipoCliente($TipoCliente) { $this->TipoCliente = $TipoCliente; }
		public function getTipoCliente() { return $this->TipoCliente; }

		public function setSetor($Setor) { $this->Setor = $Setor; }
		public function getSetor() { return $this->Setor; }

		public function setCurso($Curso) { $this->Curso = $Curso; }
		public function getCurso() { return $this->Curso; }

		public function setErro($Erro) { $this->Erro = $Erro; }
		public function getErro() { return $this->Erro; }
	}