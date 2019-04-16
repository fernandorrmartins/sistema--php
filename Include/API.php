<?php
	require_once 'ini.php';

	if(isset($_POST['CodigoCliente'])){
		$cliente = ClienteEntidade::recuperarClientePeloCodigo($_POST['CodigoCliente']);
		
		echo Util::convertObjetoEmJson($cliente);
	} else if (isset($_POST['FormularioSolicitacao'])) {
		$dados = Util::convertObjetoEmJson($_POST['FormularioSolicitacao']);
		$dados = Util::convertJsonEmObjeto($dados);

		$Erro = new ErroProjecao();

		if (ClienteEntidade::recuperarClientePeloCodigo($dados->CodigoCliente)->getErro()->getCodigo() == 0) {
			if (!ClienteEntidade::buscarCliente($dados)) {
				if (ClienteEntidade::atualizarClienteSolicitacao($dados)) {
					$Erro->setMensagem($Erro->getMensagem() . 'Dados do cliente atualizados! ');
				} else {
					$Erro->setCodigo(1);
					$Erro->setMensagem($Erro->getMensagem() . 'Não foi possível atualizar os dados do cliente! ');

					$Erro = Util::convertObjetoEmJson($Erro);

					echo $Erro;
					return;
				}
			}
		} else {
			if (ClienteEntidade::inserirCliente($dados)){
				$Erro->setMensagem($Erro->getMensagem() . 'Cliente cadastrado com sucesso! ');
			}
		}
		if (SolicitacaoEntidade::inserirSolicitacao($dados)) {
				$Erro->setMensagem($Erro->getMensagem() . 'Solicitação cadastrada com sucesso! ');
		}

		$dados = Util::convertObjetoEmJson($Erro);
		echo $dados;
	} elseif(isset($_POST['ExcluirSolicitacao'])) {
		$idSolicitacao = $_POST['ExcluirSolicitacao'];
		$Erro = new ErroProjecao();

		if(SolicitacaoEntidade::excluirSolicitacao($idSolicitacao)) {
			$Erro->setCodigo(0);
			$Erro->setMensagem('Solicitação ' . $idSolicitacao . ' excluida com sucesso! ');

			$Erro->Identificador = $idSolicitacao;
			$dados = Util::convertObjetoEmJson($Erro);
			echo $dados;
			return;
		}
		$Erro->setCodigo(1);
		$Erro->setMensagem('Não foi possível excluir a solicitação ' . $idSolicitacao . "! ");

		$Erro->Identificador = $idSolicitacao;
		$dados = Util::convertObjetoEmJson($Erro);
		echo $dados;
	} elseif(isset($_POST['ExcluirCliente'])) {
		$idSolicitacao = $_POST['ExcluirCliente'];
		$Erro = new ErroProjecao();
		$Cliente = ClienteEntidade::recuperarClientePelaSolicitacao($idSolicitacao);
		
		if($Cliente) {
			$listaSolicitacoes = SolicitacaoEntidade::excluirTodasSolicitacoesPeloCliente($Cliente->getIdentificador());

			if(ClienteEntidade::excluirCliente($Cliente->Identificador)){
				$Erro->setCodigo(0);
				$Erro->setMensagem($Erro->getMensagem() . 'Todas solicitações referentes ao cliente e o cliente foram excluidas com sucesso! ');

				$listaSolicitacoes = Util::convertObjetoEmJson($listaSolicitacoes);
				echo $listaSolicitacoes;
				return;
			}
			$Erro->setCodigo(1);
			$Erro->setMensagem($Erro->getMensagem() . 'Não foi possível excluir o cliente ' . $idCliente . "! ");

			$dados = Util::convertObjetoEmJson($Erro);
			echo $dados;
			return;
		}
		$Erro->setCodigo(1);
		$Erro->setMensagem($Erro->getMensagem() . 'Não foi possível excluir a solicitação ' . $idSolicitacao . '! ');

		$dados = Util::convertObjetoEmJson($Erro);
		echo $dados;
	}
?>