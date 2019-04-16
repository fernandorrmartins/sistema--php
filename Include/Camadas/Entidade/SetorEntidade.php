<?php
	/**
	 * Classe responsável por representar os Setores
	 * Possui os atributos da tabela Setor e seus respectivos métodos
	 */
	class SetorEntidade {
		/**
		 * Atributos da Classe Curso
		 */
		public $Identificador;
		public $Setor;

		public $Erro;
		/**
		 * Método Construtor da Classe
		 */
		function __construct() { $this->Erro = new ErroProjecao(); }

		public static function recuperarListaSetor(){
			try {
				$PDO = db_connect();
				$query = " SELECT * FROM setor ORDER BY Setor ASC; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$listSetor = $stmt->fetchAll(PDO::FETCH_OBJ);

				foreach ($listSetor as $key => $setor) {
					$listSetor[$key] = SetorEntidade::preencherSetor($setor);
				}

				return $listSetor;
			} catch (Exception $e) {
				$setor = new SetorEntidade();

				$setor->Erro->setCodigo(1);
				$setor->Erro->setMensagem($e->getMessage());

				return $setor;
			}
		}

		public static function preencherSetor($dados) {
			if(is_string($dados))
				$dados = Util::convertJsonEmObjeto($dados);

			$setor = new SetorEntidade();

			$setor->setIdentificador($dados->Identificador);
			$setor->setSetor($dados->Setor);

			if(isset($dados->Erro) and !empty($dados->Erro)){
				$setor->Erro->setCodigo($dados->Erro->Codigo);
				$setor->Erro->setMensagem($dados->Erro->Mensagem);
			}

			return $setor;
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setIdentificador($Identificador){ $this->Identificador = $Identificador; }
		public function getIdentificador(){ return $this->Identificador; }

		public function setSetor($Setor){ $this->Setor = $Setor; }
		public function getSetor(){ return $this->Setor; }

		public function setErro($Erro){ $this->Erro = $Erro; }
		public function getErro(){ return $this->Erro; }
	}