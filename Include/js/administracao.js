<script type="text/javascript">

	var url = "Include/API.php";
	var parse_email = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
	var parse_celular = /^\([0-9]{2}\)[0-9]{5}-[0-9]{4}/i;
	var parse_cep = /^[0-9]{5}-[0-9]{3}/i;
	$(document).ready(function(){
		function alterarSolicitacao(e) {
			if (confirm('Deseja alterar a solicitação?')) {
				var data = {"AlterarSolicitacao" : e.target.value};
				$.post(url, data,
					  function(data, status){
					    alert("Tarefa não implementada!");
					  });
			}
		}

		function excluirSolicitacao(e) {
			if (confirm('Deseja excluir a solicitação do usuário?')) {
				var data = {"ExcluirSolicitacao" : e.target.value};
				$.post(url, data,
					  function(data, status){
					  	data = JSON.parse(data);
					    if(data.Codigo == 0) {
					    	document.getElementById('tabelaSolicitacoes').deleteRow(
					    			document.getElementById('tr' + e.target.value).rowIndex
					    		);
					    	alert('Solicitação excluida com sucesso!');
					    } else {
					    	alert('Não foi possível excluir a solicitação!');
					    }
					  });
			}
		}

		function excluirCliente(e) {
			if (confirm('Deseja excluir o usuário? Todas as solicitações do usuário serão excluidas.')) {
				var data = {"ExcluirCliente" : e.target.value};
				$.post(url, data,
					  function(data, status){
					  	data = JSON.parse(data);
					    if(!data.Codigo) {
					    	document.getElementById('tabelaSolicitacoes').deleteRow(
					    			document.getElementById('tr' + e.target.value).rowIndex
					    		);
					    	alert(data.Erro.Mensagem);
					    } else {
					    	alert('Não foi possível excluir a solicitação!');
					    }
					  });
			}
		}

		//Busca todos os elementos da classe 'btn'
		var btnAlterar = document.getElementsByName('btnAlterar');
		for (i = 0; i < btnAlterar.length; i++){
		    btnAlterar[i].addEventListener("click", alterarSolicitacao);
		}

		var btnExcluirSolicitacao = document.getElementsByName('btnExcluirSolicitacao');
		for (i = 0; i < btnExcluirSolicitacao.length; i++){
		    btnExcluirSolicitacao[i].addEventListener("click", excluirSolicitacao);
		}

		var btnExcCliente = document.getElementsByName('btnExcCliente');
		for (i = 0; i < btnExcCliente.length; i++){
		    btnExcCliente[i].addEventListener("click", excluirCliente);
		}
	});
</script>