<?php
	/**
	 * Classe TipoClienteEnumerador é responsável por representar os Enumeradores para cada Tipo de Cliente
	 * Possui todos enumeradores do Tipo de Cliente
	 */
	abstract class TipoClienteEnumerador
	{
		const ALUNO = 1;
		const PROFESSOR = 2;
		const TECNICO = 3;

		/**
		 * Método estatico que retorna Descrição do Tipo de Cliente
		 */
		public static function desc($enum){
			return ($enum == 1 ? 'Aluno' :
				($enum == 2 ? 'Professor' :
					($enum == 3 ? 'Técnico' :
						NULL)));
		}
	}