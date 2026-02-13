<h1>
    <span class="logo">
        <?php
            $htmlImage = '<img src="'.$this->url->dir().'plugins/GecosTheme/Assets/img/gecos.png" alt="Gecos Plugin" title="Gecos Plugin" class="logo-gecos" style="width: 32px; height: 32px;"/>';
            echo $this->url->link($htmlImage, 'DashboardController', 'projects', array(), false, '', t('Dashboard'));
        ?>
    </span>
    <span class="title">
        <?php if (! empty($project) && ! empty($task)): ?>
            <?= $this->url->link($this->text->e($project['name']), 'BoardViewController', 'show', array('project_id' => $project['id'])) ?>
        <?php else: ?>
            <?= $this->text->e($title) ?>
            <?php if (! empty($project) && $project['task_limit'] && array_key_exists('nb_active_tasks', $project)): ?>
              (<span><?= intval($project['nb_active_tasks']) ?></span> / <span title="<?= t('Task limit') ?>"><span class="ui-helper-hidden-accessible"><?= t('Task limit') ?> </span><?= $this->text->e($project['task_limit']) ?></span>)
            <?php endif ?>
        <?php endif ?>
    </span>
    <?php if (! empty($description)): ?>
        <?= $this->app->tooltipHTML($description) ?>
    <?php endif ?>
</h1>
