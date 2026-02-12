<?php

namespace Kanboard\Plugin\GecosTheme;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
public function initialize()
{
    $this->hook->on('template:layout:css', array('template' => 'plugins/GecosTheme/Assets/css/theme.css'));
    $this->helper->register('gecos', '\Kanboard\Plugin\GecosTheme\Helper\GecosTheme');

    $this->template->setTemplateOverride('project_header/search', 'GecosTheme:project_header/search');
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