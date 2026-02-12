<?php if (isset($project['id'])): ?>
    <div style="margin-bottom: 15px;">
        <?= $this->helper->gecos->renderCreateButton($project['id']) ?>
    </div>
<?php endif ?>