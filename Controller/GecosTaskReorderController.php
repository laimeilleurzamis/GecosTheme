<?php

namespace Kanboard\Plugin\GecosTheme\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Controller\AccessForbiddenException;

class GecosTaskReorderController extends BaseController
{
    public function reorderColumn()
    {
        $this->checkCSRFParam();
        $project = $this->getProject();

        if (! $this->helper->user->hasProjectAccess('TaskModificationController', 'update', $project['id'])) {
            throw new AccessForbiddenException();
        }

        $swimlaneID = $this->request->getIntegerParam('swimlane_id');
        $columnID = $this->request->getIntegerParam('column_id');
        $direction = $this->request->getStringParam('direction');
        $sort = $this->request->getStringParam('sort');

        error_log("[GecosTheme] Reorder Triggered: Project=".$project['id']." | Column=".$columnID." | Direction=".$direction." | Sort=".$sort);

        if ($sort === 'date-creation') {
            $this->gecosTaskReorderModel->reorderByCreationDate($project['id'], $swimlaneID, $columnID, $direction);
        } else {
            $this->taskReorderModel->reorderColumn($project['id'], $swimlaneID, $columnID, $direction, $sort);
        }

        $this->response->redirect($this->helper->url->to('BoardViewController', 'show', ['project_id' => $project['id']]));
    }
}