<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('New task') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('TaskCreationController', 'save', array('project_id' => $project['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <div class="task-form-container">
        <div class="task-form-main-column">
            <?= $this->task->renderTitleField($values, $errors) ?>
            <?= $this->task->renderDescriptionField($values, $errors) ?>
            <?= $this->task->renderDescriptionTemplateDropdown($project['id']) ?>
            <?= $this->task->renderTagField($project) ?>

            <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column" style="width: 40% !important; max-width: 10000px !important; padding: 0 50px !important;">
            <?= $this->task->renderAssigneeField($users_list, $values, $errors) ?>
            <?= $this->task->renderSwimlaneField($swimlanes_list, $values, $errors) ?>
            <?= $this->task->renderColumnField($columns_list, $values, $errors) ?>
            <?= $this->task->renderPriorityField($project, $values) ?>

            <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <!--div class="task-form-secondary-column">
            <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
        </div-->

        <div class="task-form-bottom">

            <?= $this->hook->render('template:task:form:bottom-before-buttons', array('values' => $values, 'errors' => $errors)) ?>

            <?= $this->modal->submitButtons() ?>
        </div>
    </div>
</form>
