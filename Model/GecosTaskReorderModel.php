<?php

namespace Kanboard\Plugin\GecosTheme\Model;

use Kanboard\Model\TaskModel;
use Kanboard\Model\TaskReorderModel;

class GecosTaskReorderModel extends TaskReorderModel
{
    public function reorderByCreationDate($projectID, $swimlaneID, $columnID, $direction)
    {
        $this->db->startTransaction();

        $taskIDs = $this->db->table(TaskModel::TABLE)
            ->eq('project_id', $projectID)
            ->eq('swimlane_id', $swimlaneID)
            ->eq('column_id', $columnID)
            ->orderBy('date_creation', $direction)
            ->orderBy(TaskModel::TABLE.'.id', $direction)
            ->findAllByColumn('id');

        // Log du résultat de la requête SQL
        error_log("[GecosTheme] SQL Result for ".$direction.": " . implode(', ', $taskIDs));

        if (!empty($taskIDs)) {
            $this->reorderTasks($taskIDs);
        }

        $this->db->closeTransaction();
    }
}