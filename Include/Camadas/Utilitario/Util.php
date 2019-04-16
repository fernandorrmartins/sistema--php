<?php
	/**
	 * Classe Util é responsável por funções estáticas que podem ser utilizadas em varias áreas
	 * e em qualquer classe para fins de facilitar e agilizar o desenvolvimento do código
	 * e aplicar reutilização de código, onde se altera em um lugar, e é modificado em todo o projeto
	 */
	class Util
	{
		// Converte datas entre os padrões ISO e brasileiro
		public static function dateConvert($date) {
			if (!strstr($date, '/')){
				// $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
				// para dd/mm/yyyy
				sscanf($date, '%d-%d-%d %d:%d:%d', $y, $m, $d, $h, $m, $s);
				return sprintf('%02d:%02d:%02d %02d/%02d/%04d', $h, $m, $s, $d, $m, $y);
			} else {
				// $date está no formato brasileiro e deve ser convertida para ISO
				sscanf($date, '%d/%d/%d %d:%d:%d', $d, $m, $y, $h, $m, $s);
				return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $y, $m, $d, $h, $m, $s);
			}
			return false;
		}

		// Converte um Json em Objeto
		public static function convertJsonEmObjeto($dados){
			if (is_string($dados))
				$dados = json_decode($dados);
			
			return $dados;
		}

		// Converte um Objeto em Json
		public static function convertObjetoEmJson($dados){
			$dados = json_encode($dados);
			
			return $dados;
		}

		// Verifica se foi incluido um caracter proibido na entrada do usuário
		public static function varificarSqlInjection($valor){
			if(strstr($valor, "'") or strstr($valor, '"')){
				return true;
			}

			return false;
		}
	}