<?php
	/**
	 * Classe Erro é responsável por representar os erros que ocorrem em processamento
	 * e apresenta ao usuário final
	 */
	class ErroProjecao {
		/**
		 * Atributos da Classe ErroProjecao
		 */
		public $Codigo;
		public $Mensagem;

		/**
		 * Método Construtor da Classe
		 */
		function __construct() { 
			$this->setCodigo(0); 
			$this->setMensagem("");
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setCodigo($Codigo){ $this->Codigo = $Codigo; }
		public function getCodigo(){ return $this->Codigo; }

		public function setMensagem($Mensagem){ $this->Mensagem = $Mensagem; }
		public function getMensagem(){ return $this->Mensagem; }
	}