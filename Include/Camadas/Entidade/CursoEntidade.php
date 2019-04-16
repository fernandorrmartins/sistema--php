<?php
	/**
	 * Classe responsável por representar os Cursos
	 * Possui os atributos da tabela Curso e seus respectivos métodos
	 */
	class CursoEntidade {
		/**
		 * Atributos da Classe CursoEntidade
		 */
		public $Identificador;
		public $Curso;

		public $Erro;

		/**
		 * Método Construtor da Classe
		 */
		function __construct() { $this->Erro = new ErroProjecao(); }

		public static function recuperarListaCurso() {
			try {
				$PDO = db_connect();
				$query = " SELECT * FROM curso ORDER BY Curso ASC; ";
				$stmt = $PDO->prepare($query);
				$stmt->execute();
				$listCurso = $stmt->fetchAll(PDO::FETCH_OBJ);

				foreach ($listCurso as $key => $curso) {
					$listCurso[$key] = CursoEntidade::preencherCurso($curso);
				}

				return $listCurso;
			} catch (Exception $e) {
				$curso = new CursoEntidade();

				$curso->Erro->setCodigo(1);
				$curso->Erro->setMensagem($e->getMessage());

				return $curso;
			}
		}

		public static function preencherCurso($dados) {
			if(is_string($dados))
				$dados = Util::convertJsonEmObjeto($dados);

			$curso = new CursoEntidade();

			$curso->setIdentificador($dados->Identificador);
			$curso->setCurso($dados->Curso);

			if(isset($dados->Erro) and !empty($dados->Erro)){
				$curso->Erro->setCodigo($dados->Erro->Codigo);
				$curso->Erro->setMensagem($dados->Erro->Mensagem);
			}

			return $curso;
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setIdentificador($Identificador) { $this->Identificador = $Identificador; }
		public function getIdentificador() { return $this->Identificador; }

		public function setCurso($Curso) { $this->Curso = $Curso; }
		public function getCurso() { return $this->Curso; }

		public function setErro($Erro) { $this->Erro = $Erro; }
		public function getErro() { return $this->Erro; }
	}