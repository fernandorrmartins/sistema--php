<?php
  $list = SolicitacaoEntidade::recuperarListaSolicitacoes();
?>
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Lista de Solicitações</a>
      </li>
    </ul>
  </div>
  <div class="card-body" style="text-align: center;">
    <table id="tabelaSolicitacoes" class="borda" min-width="80%" max-width="85%">
          <thead>
            <tr align="center">
              <th>Usuário</th>
              <th>Solicitação</th>
              <th>Data da Solicitação</th>
              <th>Tipo de Cliente</th>
              <th>Telefone</th>
              <th>E-mail</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody align="center">
            <?php
            if (is_array($list)):
            foreach ($list as $solicitacao):
              ?>
              <tr id="tr<?= $solicitacao->getIdentificador(); ?>">
                <td width="10%"><?= $solicitacao->getCliente()->getCodigoCliente(); ?></td>
                <td width="10%"><?= $solicitacao->getIdentificador(); ?></td>
                <td width="10%"><?= Util::dateConvert($solicitacao->getDataSolicitacao()); ?></td>
                <td width="10%"><?= TipoClienteEnumerador::desc($solicitacao->getCliente()->getTipoCliente()); ?></td>
                <td width="15%"><?= $solicitacao->getCliente()->getCelular(); ?></td>
                <td width="10%"><?= $solicitacao->getCliente()->getEmail(); ?></td>
                <td width="30%">
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <BUTTON id="btnAlterar" name="btnAlterar" value="<?= $solicitacao->getIdentificador(); ?>" class="btn btn-success" onclick="alterarSolicitacao(e)">Alterar</BUTTON>
                      <BUTTON id="btnExcluirSolicitacao" name="btnExcluirSolicitacao" value="<?= $solicitacao->getIdentificador(); ?>" class="btn btn-warning">Excluir</BUTTON>
                      <BUTTON id="btnExcCliente" name="btnExcCliente" value="<?= $solicitacao->getIdentificador(); ?>" class="btn btn-danger">Exc.Cliente</BUTTON>
                  </div>
                </td>
              </tr>
            <?php
            endforeach; 
            else:
              echo '<center><text>' . $list->getErro()->getMensagem() . '</text></center>';
            endif;
            ?>
          </tbody>
        </table>
    </table>
  </div>
</div>