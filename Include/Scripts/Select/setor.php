<?php
      $list = SetorEntidade::recuperarListaSetor();
?>
<div class="form-group">
      <label for="setor">Setor</label><br>
      <select id="setor" class="form-control">
      <?php foreach($list as $setor): ?>
                  <option value="<?= $setor->getIdentificador(); ?>">
                        <?= $setor->getSetor(); ?>
                  </option>
      <?php endforeach; ?>
      </select>
</div>