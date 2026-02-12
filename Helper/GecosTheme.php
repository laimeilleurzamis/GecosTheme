<?php

namespace Kanboard\Plugin\GecosTheme\Helper;

use Kanboard\Core\Base;

class GecosTheme extends Base
{
    /**
     * Génère un bouton "Créer une alerte"
     * @param  int $project_id
     * @return string HTML
     */
    public function renderCreateButton($project_id)
    {
        $columnId = $this->columnModel->getFirstColumnId($project_id);
        
        $swimlaneId = $this->swimlaneModel->getFirstActiveSwimlaneId($project_id);

        if (empty($columnId) || empty($swimlaneId)) {
            return ''; 
        }

        return $this->helper->url->link(
            '<i class="fa fa-plus"></i> ' . t('Créer une alerte'), 
            'TaskCreationController',
            'show',
            array(
                'project_id'  => $project_id,
                'column_id'   => $columnId,
                'swimlane_id' => $swimlaneId,
            ),
            false,
            'global-create-btn js-modal-large'
        );
    }
}