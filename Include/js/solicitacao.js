<script type="text/javascript">

	var url = "Include/API.php";
	var parse_email = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
	var parse_celular = /^\([0-9]{2}\)[0-9]{5}-[0-9]{4}/i;
	var parse_cep = /^[0-9]{5}-[0-9]{3}/i;
	$(document).ready(function(){
		var idCont = document.getElementById("cont");

		var idCodigoCliente = document.getElementById("codigoCliente");
		var idNome = document.getElementById("nome");
		var idCelular = document.getElementById("celular");
		var idEmail = document.getElementById("email");
		var idRua = document.getElementById("rua");
		var idNumero = document.getElementById("numero");
		var idBairro = document.getElementById("bairro");
		var idCidade = document.getElementById("cidade");
		var idCep = document.getElementById("cep");
		var idEstado = document.getElementById("estado");
		var idTipoCliente = document.getElementById("tipoCliente");
		var idSetor = document.getElementById("setor");
		var idCurso = document.getElementById("curso");
		var idServicoSolicitado = document.getElementById("servicoSolicitado");

		function definirTipoCliente(value) {
	    	if(value == 1) {
	    		idCodigoCliente.maxLength = 7;
	    	} else if(value == 2) {
	    		idCodigoCliente.maxLength = 4;
	    	} else if(value == 3) {
	    		idCodigoCliente.maxLength = 6;
	    	}
		}
		
		function buscarCliente() {
			var data = {"CodigoCliente" : idCodigoCliente.value};
			$.post(url, data,
				  function(data, status){
				    data = JSON.parse(data);
				    if(data.Erro.Codigo == 0){
				    	if(data.TipoCliente == 1) {
				    		idCodigoCliente.maxLength = 7;
				    	} else if(data.TipoCliente == 2) {
				    		idCodigoCliente.maxLength = 4;
				    	} else if(data.TipoCliente == 3) {
				    		idCodigoCliente.maxLength = 6;
				    	}

				    	idNome.value = data.Nome;
				    	idCelular.value = data.Celular;
				    	idEmail.value = data.Email;
				    	idRua.value = data.Rua;
				    	idNumero.value = data.Numero;
				    	idBairro.value = data.Bairro;
				    	idCidade.value = data.Cidade;
				    	idCep.value = data.Cep;
				    	idEstado.value = data.Estado;
				    	idTipoCliente.value = data.TipoCliente;
				    	idSetor.value = data.Setor;
				    	idCurso.value = data.Curso;
				    }
				  });
		};
		function cadastrarAlterarCliente() {
			if(idCodigoCliente.value && idNome.value && idCelular.value && idEmail.value && idRua.value
				&& idNumero.value && idBairro.value && idCidade.value && idCep.value && idEstado.value
				&& idTipoCliente.value && idSetor.value && idCurso.value && idServicoSolicitado.value) {

				if(!parse_celular.test(idCelular.value)) {
					alert("Por favor digite um celular válido!");
					return;
				}
				if(!parse_email.test(idEmail.value)) {
					alert("Por favor digite um e-mail válido!");
					return;
				}
				if(!parse_cep.test(idCep.value)) {
					alert("Por favor digite um cep válido!");
					return;
				}
				var obj = new Object();
				obj.CodigoCliente = idCodigoCliente.value;
				obj.Nome = idNome.value;
				obj.Celular = idCelular.value;
				obj.Email = idEmail.value;
				obj.Rua = idRua.value;
				obj.Numero = idNumero.value;
				obj.Bairro = idBairro.value;
				obj.Cidade = idCidade.value;
				obj.Cep = idCep.value;
				obj.Estado = idEstado.value;
				obj.TipoCliente = idTipoCliente.value;
				obj.Setor = idSetor.value;
				obj.Curso = idCurso.value;
				obj.ServicoSolicitado = idServicoSolicitado.value;

				var data = {"FormularioSolicitacao" : obj};
				$.post(url, data,
					function(data, status){
						var erro = JSON.parse(data);
						alert(erro.Mensagem);
					});

			} else {
				alert("Verifique se todos os campos foram preenchidos!");
			}
		}
		idCodigoCliente.onkeyup = function() { buscarCliente() };
		document.getElementById("btnConfirmar").onclick = function() { cadastrarAlterarCliente(); };
		idTipoCliente.onchange = function(){ definirTipoCliente(this.value); };
	});
</script>