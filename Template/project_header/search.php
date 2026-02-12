<div class="filter-box component">
    <form method="get" action="<?= $this->url->dir() ?>" class="search">
        
        <?php if (isset($project['id'])): ?>
            <?= $this->helper->gecos->renderCreateButton($project['id']) ?>
        <?php endif ?>
        <?= $this->form->hidden('controller', $filters) ?>
        <?= $this->form->hidden('action', $filters) ?>
        <?= $this->form->hidden('plugin', $filters) ?>
        <?= $this->form->hidden('project_id', $filters) ?>

        <div class="input-addon">
            <?= $this->form->text('search', $filters, array(), array(
                'placeholder="'.t('Filter').'"',
                'aria-label="'.t('Filter').'"',
            ), 'input-addon-field') ?>
            
            <div class="input-addon-item">
                <?= $this->render('app/filters_helper', array('reset' => 'status:open', 'project' => $project)) ?>
            </div>
        </div>

    </form>
</div>