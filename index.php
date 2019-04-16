<?php
	require_once 'Include/inisite.php';
	if(isset($_POST['btnAdministracao']))
		require_once 'administracao.php';
	elseif(isset($_POST['btnSolicitacao']))
		require_once 'solicitacao.php';
	else
		require_once 'solicitacao.php';
?>

<?php
	require_once 'Include/Scripts/Rodape.php';
?>