<?php
	/**
	 * Classe responsável por E-mail
	 * Possui os atributos de um E-mail e seus respectivos métodos
	 */
	class EmailEntidade {
		/**
		 * Atributos da Classe E-mail
		 */
		public $Assunto;
		public $Nome;
		public $Email;
		public $Headers;
		public $Mensagem;

		public $Erro;
		/**
		 * Método Construtor da Classe
		 */
		function __construct() { $this->Erro = new ErroProjecao(); }

		/**
		 * Método responsável por enviar o e-mail depois de preenchido
		 */
		public function enviarEmail() {
			try {
				if (isset($this->Assunto) or empty($this->Assunto)
					or isset($this->Nome) or empty($this->Nome)
					or isset($this->Email) or empty($this->Email)
					or isset($this->Mensagem) or empty($this->Mensagem)){
					throw new Exception("Preencha todos os dados necessários para enviar o e-mail!", 1);
					
				}
				 
				// É necessário indicar que o formato do e-mail é html
				$this->Headers= 'MIME-Version: 1.0' . "\r\n";
				$this->Headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$this->Headers .= 'From:  ' . $this->Nome . ' ' . $this->Email;
				 
				$enviaremail = mail($this->Destino, $this->Assunto, $this->Mensagem, $this->Headers);
			} catch (Exception $e) {
				$this->Erro->setCodigo(1);
				$this->Erro->setCodigo($e->getMessage());
			}
		}

		/**
		 * Métodos gets e sets da classe
		 * responsáveis por recuperar e definir os atributos privados da classe
		 */
		public function setAssunto($Assunto){ $this->Assunto = $Assunto; }
		public function getAssunto(){ return $this->Assunto; }

		public function setNome($Nome){ $this->Nome = $Nome; }
		public function getNome(){ return $this->Nome; }

		public function setEmail($Email){ $this->Email = $Email; }
		public function getEmail(){ return $this->Email; }

		public function setHeaders($Headers){ $this->Headers = $Headers; }
		public function getHeaders(){ return $this->Headers; }

		public function setMensagem($Mensagem){ $this->Mensagem = $Mensagem; }
		public function getMensagem(){ return $this->Mensagem; }

		public function setErro($Erro){ $this->Erro = $Erro; }
		public function getErro(){ return $this->Erro; }
	}