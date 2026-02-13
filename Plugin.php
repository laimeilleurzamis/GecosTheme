<?php

namespace Kanboard\Plugin\GecosTheme;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/theme.css'));

        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/userPage/userPage.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dashboardPage/dashboardPage.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dashboardPage/activityView.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/createAlerte/createAlerte.css'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/dropdown.css'));

        $this->hook->on('template:layout:js', array('template' => 'plugins/GecosTheme/Assets/js/dropdown.js'));

        $this->helper->register('gecos', '\Kanboard\Plugin\GecosTheme\Helper\GecosTheme');

        $this->template->setTemplateOverride('project_header/search', 'GecosTheme:project_header/search');
        $this->template->setTemplateOverride('header/title', 'GecosTheme:header/title');
        $this->template->setTemplateOverride('header/user_dropdown', 'GecosTheme:header/user_dropdown');
        $this->template->setTemplateOverride('task/details', 'GecosTheme:task/details');
        $this->template->setTemplateOverride('task/show', 'GecosTheme:task/show');
        $this->template->setTemplateOverride('task/sidebar', 'GecosTheme:task/sidebar');

        $this->route->addRoute('/gecostheme/move', 'MoveTaskController', 'move', 'GecosTheme');
        $this->route->addRoute('/gecostheme/update-priority', 'MoveTaskController', 'updatePriority', 'GecosTheme');
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