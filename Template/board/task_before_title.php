<style>
    .task-dates * {
        color: #555;
    }
</style>

<div class="task-dates">
    <div class="task-date">
        <strong><?= t('Created:') ?></strong>
        <?php if ($task['date_due']): ?>
            <span><?= $this->dt->datetime($task['date_due']) ?></span>
        <?php else: ?>
            <span><?= $this->dt->datetime($task['date_creation']) ?></span>
        <?php endif ?>
    </div>
    <?php if ($task['date_completed']): ?>
        <div class="task-date">
            <strong><?= t('Completed:') ?></strong>
            <span><?= $this->dt->datetime($task['date_completed']) ?></span>
        </div>
    <?php elseif ($task['date_started']): ?>
        <div class="task-date">
            <strong><?= t('Started:') ?></strong>
            <span><?= $this->dt->datetime($task['date_started']) ?></span>
        </div>
    <?php endif ?>
</div>