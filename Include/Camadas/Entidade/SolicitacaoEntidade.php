<?php
	require_once 'ClienteEntidade.php';
	/**
	 * Classe responsável por representar as Solicitações
	 * Possui os atributos da tabela Solicitacao e seus respectivos métodos
	 */
	class SolicitacaoEntidade {
		/**
		 * Atributos da Classe SolicitacaoEntidade
		 */
		public $Identificador;
		public $Cliente;
		public $ServicoSolicitado;
		public $DataSolicitacao;

		public $Erro;

		/**
		 * Método Construtor da Classe
		 */
		function __construct() {
			$this->Cliente = new ClienteEntidade();
			$this->Erro = new ErroProjecao();
		}

		public static function excluirSolicitacao($idSolicitacao){
			try {
				$PDO = db_connect();
				$query = " DELETE FROM solicitacao ";
				$query .= " WHERE Identificador = " . $idSolicitacao . "; ";
				$stmt = $PDO->prepare($query);
				$deletou = $stmt->execute();

				return $deletou;
			} catch (Exception $e) {
				$solicitacao = new SolicitacaoEntidade();

				$solicitacao->Erro->setCodigo(1);
				$solicitacao->Erro->setMensagem($e->getMessage());

				return $solicitacao;
			}
		}

		public static function excluirTodasSolicitacoesPeloCliente($idCliente){
			try {
				$PDO = db_connect();
				$query = " SELECT * FROM solicitacao ";
				$query .= " WHERE Cliente = " . $idCliente . "; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$listSolicitacao = $stmt->fetchAll(PDO::FETCH_OBJ);

				foreach ($listSolicitacao as $key => $solicitacao) {
					$listSolicitacao[$key] = SolicitacaoEntidade::preencherSolicitacao($solicitacao);
					$listSolicitacao[$key]
						->setCliente(ClienteEntidade::recuperarClientePelaSolicitacao($solicitacao->Identificador));
				}

				$query = " DELETE FROM solicitacao ";
				$query .= " WHERE Cliente = " . $idCliente . "; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();

				return $listSolicitacao;
			} catch (Exception $e) {
				$solicitacao = new SolicitacaoEntidade();

				$solicitacao->Erro->setCodigo(1);
				$solicitacao->Erro->setMensagem($e->getMessage());

				return $solicitacao;
			}
		}

		public static function inserirSolicitacao($dados){
			try {
				$PDO = db_connect();
				$query = " INSERT INTO solicitacao(Cliente, ServicoSolicitado)
							VALUES(
								(SELECT Identificador FROM cliente WHERE CodigoCliente = '$dados->CodigoCliente'), '$dados->ServicoSolicitado'); ";
				$stmt = $PDO->prepare($query);
				$inseriu = $stmt->execute();

				return $inseriu;
			} catch (Exception $e) {
				$solicitacao = new SolicitacaoEntidade();

				$solicitacao->Erro->setCodigo(1);
				$solicitacao->Erro->setMensagem($e->getMessage());

				return $solicitacao;
			}
		}

		public static function recuperarListaSolicitacoes() {
			try {
				$PDO = db_connect();
				$query = " SELECT s.Identificador, s.ServicoSolicitado, s.DataSolicitacao FROM solicitacao s ORDER BY s.DataSolicitacao ASC; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$listSolicitacao = $stmt->fetchAll(PDO::FETCH_OBJ);

				foreach ($listSolicitacao as $key => $solicitacao) {
					$listSolicitacao[$key] = SolicitacaoEntidade::preencherSolicitacao($solicitacao);
					$listSolicitacao[$key]
						->setCliente(ClienteEntidade::recuperarClientePelaSolicitacao($solicitacao->Identificador));
				}

				return $listSolicitacao;
			} catch (Exception $e) {
				$solicitacao = new SolicitacaoEntidade();

				$solicitacao->Erro->setCodigo(1);
				$solicitacao->Erro->setMensagem($e->getMessage());

				return $solicitacao;
			}
		}

		public static function preencherSolicitacao($dados) {
			if(is_string($dados))
				$dados = Util::convertJsonEmObjeto($dados);

			$solicitacao = new SolicitacaoEntidade();

			$solicitacao->setIdentificador($dados->Identificador);
			$solicitacao->setServicoSolicitado($dados->ServicoSolicitado);
			$solicitacao->setDataSolicitacao($dados->DataSolicitacao);

			if(isset($dados->Erro) and !empty($dados->Erro)){
				$solicitacao->Erro->setCodigo($dados->Erro->Codigo);
				$solicitacao->Erro->setMensagem($dados->Erro->Mensagem);
			}

			return $solicitacao;
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setIdentificador($Identificador) { $this->Identificador = $Identificador; }
		public function getIdentificador() { return $this->Identificador; }

		public function setCliente($Cliente) { $this->Cliente = $Cliente; }
		public function getCliente() { return $this->Cliente; }

		public function setServicoSolicitado($Solicitacao) { $this->Solicitacao = $Solicitacao; }
		public function getServicoSolicitado() { return $this->Solicitacao; }

		public function setDataSolicitacao($DataSolicitacao) {
			Util::dateConvert($DataSolicitacao);
			$this->DataSolicitacao = $DataSolicitacao;
		}
		public function getDataSolicitacao() { return $this->DataSolicitacao; }
	}