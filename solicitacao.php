<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Solicitação</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Formulário de Solicitação</h5>
    <p class="card-text">Preencha o formulário para fazer uma solicitação.</p>
    <center>
      <div class="row" style="width: 80%;">
        <div class="card-group" style="width: 100%;">
          <div class="card" style="min-width: 50%;">
            <h5 class="card-header">Cliente</h5>
            <div class="row" style="width: 100%;">
              <div class="col-md-6">
                <label for="codigoCliente">Código do Cliente</label><br>
                <input id="codigoCliente" type="text" placeholder="Ex: 0000001" name="codigoCliente" maxlength="7"><br>
                <label for="celular">Celular</label><br>
                <input id="celular" type="text" placeholder="Ex: (99)99999-9999" name="celular" maxlength="14"><br>
                <?php require_once 'Include/Scripts/Select/tipocliente.php'; ?>
              </div>
              <div class="col-md-6">
                <label for="nome">Nome</label><br>
                <input id="nome" type="text" placeholder="Ex: Joaquim Manuel" name="nome" maxlength="60"><br>
                <label for="email">Email</label><br>
                <input id="email" type="text" placeholder="Ex: exemplo@gmail.com" name="email" maxlength="40"><br>
              </div>
            </div>
          </div>
          <div class="card" style="min-width: 50%;">
            <h5 class="card-header">Endereço</h5>
            <div class="row" style="width: 100%;">
              <div class="col-md-6">
                <label for="rua">Rua</label><br>
                <input id="rua" type="text" placeholder="Ex: Av. Valeriano" name="rua" maxlength="200"><br>
                <label for="bairro">Bairro</label><br>
                <input id="bairro" type="text" placeholder="Ex: Centro" name="bairro" maxlength="100"><br>
                <label for="cep">Cep</label><br>
                <input id="cep" type="text" placeholder="Ex: 37777-000" name="cep" maxlength="9"><br>
              </div>
              <div class="col-md-6">
                <label for="numero">Número</label><br>
                <input id="numero" type="text" placeholder="Ex: 105" name="numero" maxlength="11"><br>
                <label for="cidade">Cidade</label><br>
                <input id="cidade" type="text" placeholder="Ex: Rio Branco" name="cidade" maxlength="100"><br>
                <?php require_once 'Include/Scripts/Select/estados.php'; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="min-width: 60%; max-width: 80%;">
        <div class="card-group" style="width: 100%;">
          <div class="card text-center" style="width: 100%;">
            <h5 class="card-header">Área</h5>
            <div class="row">
              <div class="col-md-6">
                <?php require_once 'Include/Scripts/Select/setor.php'; ?>
              </div>
              <div class="col-md-6">
                <?php require_once 'Include/Scripts/Select/curso.php'; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="min-width: 60%; max-width: 80%;">
        <div class="card-group" style="width: 100%;">
          <div class="card text-center" style="width: 100%;">
            <h5 class="card-header">Solicitação</h5>
            <div class="row">
              <div class="col-md-12">
                <label for="servicoSolicitado">Serviço Solicitado</label><br>
                <textarea id="servicoSolicitado" type="text" placeholder="Ex: Internet não esta funcionando" name="servicoSolicitado" maxlength="400" style="min-width: 80%; max-width: 100%;"></textarea>
                <br>
            </div>
          </div>
        </div>
      </div>
    </center>
    <BUTTON id="btnConfirmar" name="btnConfirmar" type="submit" class="btn btn-primary">Confirmar</BUTTON>
  </div>
</div>