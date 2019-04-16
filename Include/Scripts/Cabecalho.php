<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="Include/Interface/logo.png">
		
		<meta property="og:title" content="Unilavras" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://unilavras.edu.br/" />
		<meta property="og:image" content="Include/Interface/logo.png" />
		
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<link rel="stylesheet" type="text/css" href="Include/css/estilo.css">

		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<meta charset="utf-8">
		<meta view="viewport" content="width=device-width, initial-scale=1.0">
		<?php
			// JavaScript
			if(isset($_POST['btnAdministracao']))
				require_once 'Include/js/administracao.js';
			elseif(isset($_POST['btnSolicitacao']))
				require_once 'Include/js/solicitacao.js';
			else
				require_once 'Include/js/solicitacao.js';
		?>

		<title></title>
	</head>
<body style="background-size: 100% 100%;">