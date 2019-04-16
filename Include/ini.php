<?php
	// Pasta Raiz do Projeto
	//define('ROOT_PATH', $_SERVER['DOCUMEN_ROOT']);
	// Constantes com as credenciais de acesso ao banco MySQL
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'unilavras');

	// Habilita todas as exeibições de erros
	ini_set('display_errors', true);
	error_reporting(E_ALL);

	date_default_timezone_set('America/Sao_Paulo');

	// Arquivos Requisitos para Aplicação
	require_once 'db.php';
	// Utilitários
	require_once 'Camadas/Utilitario/Util.php';
	// Projeções
	require_once 'Camadas/Projecao/ErroProjecao.php';
	// Entidades(Objetos)
	require_once 'Camadas/Entidade/ClienteEntidade.php';
	require_once 'Camadas/Entidade/CursoEntidade.php';
	require_once 'Camadas/Entidade/SetorEntidade.php';
	require_once 'Camadas/Entidade/SolicitacaoEntidade.php';
	require_once 'Camadas/Entidade/EmailEntidade.php';
	// Enumeradores
	require_once 'Camadas/Enumerador/TipoClienteEnumerador.php';
