<?php
$columnsList = $this->task->projectModel->columnModel->getList($task['project_id']);
$columnsJson = htmlspecialchars(json_encode($columnsList), ENT_QUOTES, 'UTF-8');
?>
<?php 
    $available_users = $this->task->projectUserRoleModel->getAssignableUsersList($task['project_id']);
?>

<section id="task-summary">
    <h2><?= $this->text->e($task['title']) ?></h2>

    <?= $this->hook->render('template:task:details:top', array('task' => $task)) ?>

    <div class="task-summary-container color-<?= $task['color_id'] ?>">
        <div class="task-summary-columns">
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <!-- Status shows now a button wich show the column and allow to change it -->
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <strong><?= t('Status:') ?></strong>
                        <div class="task-custom-footer-inline modal-view-button" onclick="event.stopPropagation();">
                            <div class="dropdown column-dropdown" 
                                data-project-id="<?= $task['project_id'] ?>"
                                data-task-id="<?= $task['id'] ?>"
                                data-swimlane-id="<?= $task['swimlane_id'] ?>"
                                data-columns='<?= $columnsJson ?>'>
                                
                                <div class="csrf-container" style="display:none;">
                                    <?= $this->form->csrf() ?>
                                </div>

                                <span class="badge-task-item status-column dropdown-toggle" 
                                    title="Cliquez pour changer de colonne" 
                                    style="cursor: pointer;" 
                                    data-column-id="<?= $task['column_id'] ?>"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="fa fa-th-list"></i> <?= $this->text->e($task['column_title']) ?>
                                </span>
                                
                                <ul class="dropdown-menu column-dropdown-menu">
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Button which show the priority and allow to change it -->
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <strong><?= t('Priority:') ?></strong>
                        <div class="task-custom-footer-inline modal-view-button" onclick="event.stopPropagation();">
                            <div class="dropdown priority-dropdown" 
                                data-project-id="<?= $task['project_id'] ?>"
                                data-task-id="<?= $task['id'] ?>">
                                
                                <span class="badge-task-item priority dropdown-toggle" 
                                    title="Cliquez pour changer la priorité" 
                                    style="cursor: pointer;" 
                                    data-current-priority="<?= $task['priority'] ?>"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="fa fa-signal"></i> <?= $task['priority'] ?>
                                </span>
                                
                                <ul class="dropdown-menu priority-menu">
                                    <?php for ($i = 0; $i <= 3; $i++): ?>
                                        <li>
                                            <a href="#" class="priority-change-link" data-priority="<?= $i ?>">
                                                Priorité <?= $i ?>
                                                <?php if ($task['priority'] == $i): ?>
                                                    <i class="fa fa-check"></i>
                                                <?php endif ?>
                                            </a>
                                        </li>
                                    <?php endfor ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Creator and assignee are now in the 1st column -->
                    <!-- Button which show the assignee and allow to change it -->
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <strong><?= t('Assignee:') ?></strong>
                        <div class="task-custom-footer-inline modal-view-button" onclick="event.stopPropagation();">
                            <div class="dropdown assignee-dropdown" 
                                data-project-id="<?= $task['project_id'] ?>"
                                data-task-id="<?= $task['id'] ?>">
                                
                                <span class="badge-task-item assignee dropdown-toggle" 
                                    title="Cliquez pour changer l'assigné" 
                                    style="cursor: pointer;" 
                                    data-current-assignee="<?= $task['owner_id'] ?>"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="fa fa-user"></i> <?= $task['assignee_name'] ?: $task['assignee_username'] ?: 'Non assigné' ?>
                                </span>

                                <ul class="dropdown-menu assignee-menu">
                                    <li>
                                        <a href="#" class="assignee-change-link" data-user-id="0">
                                        </a>
                                    </li>
                                    <?php foreach ($available_users as $user_id => $user_name): ?>
                                        <li>
                                            <a href="#" class="assignee-change-link" data-user-id="<?= $user_id ?>">
                                                <?= $this->text->e($user_name) ?>
                                                <?php if ($task['owner_id'] == $user_id): ?>
                                                    <i class="fa fa-check"></i>
                                                <?php endif ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php if ($task['creator_username']): ?>
                        <li>
                            <strong><?= t('Creator:') ?></strong>
                            <span><?= $this->text->e($task['creator_name'] ?: $task['creator_username']) ?></span>
                        </li>
                    <?php endif ?>
                    <!-- Tags section moved to the bottom of the 1st column -->
                    <?php if (! empty($tags)): ?>
                        <li class="task-tags" style="margin-top: 0;">
                            <ul>
                                <!-- Indication that labels are about the localisation -->
                                <strong style="color: #000"><?= 'Localisation :' ?></strong>
                                <?php foreach ($tags as $tag): ?>
                                    <li class="task-tag <?= $tag['color_id'] ? "color-{$tag['color_id']}" : '' ?>" style="height: 22px; margin-top: 0;"><?= $this->text->e($tag['name']) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:first-column', array('task' => $task)) ?>
                </ul>
            </div>
            <!-- 2nd and 3rd columns deleted -->
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <!-- Created date replaced by due date if ther is one, this way it is manipulable -->
                    <li>
                        <strong><?= t('Created:') ?></strong>
                        <?php if ($task['date_due']): ?>
                            <span><?= $this->dt->datetime($task['date_due']) ?></span>
                        <?php else: ?>
                            <span><?= $this->dt->datetime($task['date_creation']) ?></span>
                        <?php endif ?>
                    </li>
                    <?php if ($task['date_started']): ?>
                        <li>
                            <strong><?= t('Started:') ?></strong>
                            <span><?= $this->dt->datetime($task['date_started']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if ($task['date_completed']): ?>
                    <li>
                        <strong><?= t('Completed:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_completed']) ?></span>
                    </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:fourth-column', array('task' => $task)) ?>
                </ul>
            </div>
        </div>
    </div>

    <?php if (! empty($task['external_uri']) && ! empty($task['external_provider'])): ?>
        <?= $this->app->component('external-task-view', array(
            'url' => $this->url->href('ExternalTaskViewController', 'show', array('task_id' => $task['id'])),
        )) ?>
    <?php endif ?>

    <?= $this->hook->render('template:task:details:bottom', array('task' => $task)) ?>
</section>
