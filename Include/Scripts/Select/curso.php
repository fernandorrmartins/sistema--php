<?php
      $list = CursoEntidade::recuperarListaCurso();
?>
<div class="form-group">
      <label for="curso">Curso</label><br>
      <select id="curso" class="form-control">
      <?php foreach($list as $curso): ?>
                  <option value="<?= $curso->getIdentificador(); ?>">
                        <?= $curso->getCurso(); ?>
                  </option>
      <?php endforeach; ?>
      </select>
</div>