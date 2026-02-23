<?php

namespace Kanboard\Plugin\GecosTheme;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {

        /* --- CSS & JS Hooks --- */
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/theme.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dropdown.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/createAlerte/createAlerte.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dashboardPage/dashboardPage.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dashboardPage/activityView.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dashboardPage/taskView.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/userPage/userPage.css'));

        $this->hook->on('template:layout:js', array('template' => 'plugins/GecosTheme/Assets/js/dropdown.js'));

        $this->helper->register('gecos', '\Kanboard\Plugin\GecosTheme\Helper\GecosTheme');

        $this->template->hook->attach('template:board:private:task:before-title', 'GecosTheme:board/task_before_title');
        $this->template->hook->attach('template:layout:head', 'GecosTheme:layout/favicon');

        $this->template->setTemplateOverride('header/title', 'GecosTheme:header/title');
        $this->template->setTemplateOverride('header/user_dropdown', 'GecosTheme:header/user_dropdown');
        $this->template->setTemplateOverride('task/details', 'GecosTheme:task/details');
        $this->template->setTemplateOverride('task/show', 'GecosTheme:task/show');
        $this->template->setTemplateOverride('task/sidebar', 'GecosTheme:task/sidebar');
        $this->template->setTemplateOverride('task_creation/show', 'GecosTheme:task_creation/show');
        $this->template->setTemplateOverride('task_modification/show', 'GecosTheme:task_modification/show');

        $this->route->addRoute('/gecostheme/move', 'MoveTaskController', 'move', 'GecosTheme');
        $this->route->addRoute('/gecostheme/update-priority', 'MoveTaskController', 'updatePriority', 'GecosTheme');

        $controller = $this->request->getStringParam('controller');
        $sort = $this->request->getStringParam('sort');
        if ($controller === 'TaskReorderController' && $sort === 'due-date') {
            $this->request->setParams([
                'controller' => 'GecosTaskReorderController',
                'plugin'     => 'GecosTheme',
                'sort'       => 'date-creation',
            ]);
            $_GET['controller'] = 'GecosTaskReorderController';
            $_GET['plugin'] = 'GecosTheme';
            $_GET['sort'] = 'date-creation';
        }
        $this->container['gecosTaskReorderModel'] = function ($c) {
            return new \Kanboard\Plugin\GecosTheme\Model\GecosTaskReorderModel($c);
        };
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Gecos Interface';
    }
    
        public function getPluginDescription()
    {
        return 'Change the interface to a more modern and user-friendly design, inspiradapted for Gecos for Kanboard.';
    }

    public function getPluginAuthor()
    {
        return 'laimeilleurzamis';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return '';
    }
}