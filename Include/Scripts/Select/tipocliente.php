<div class="form-group">
      <label for="tipoCliente">Tipo de Cliente</label><br>
      <select id="tipoCliente" class="form-control" onchange="definirTipoCliente(this.value)">
            <option value="<?= TipoClienteEnumerador::ALUNO; ?>">
                  <?= TipoClienteEnumerador::desc(TipoClienteEnumerador::ALUNO); ?>
            </option>
            <option value="<?= TipoClienteEnumerador::PROFESSOR; ?>">
                  <?= TipoClienteEnumerador::desc(TipoClienteEnumerador::PROFESSOR); ?>
            </option>
            <option value="<?= TipoClienteEnumerador::TECNICO; ?>">
                  <?= TipoClienteEnumerador::desc(TipoClienteEnumerador::TECNICO); ?>
            </option>
      </select>
</div>