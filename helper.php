<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class ModSubNewsHelper {

    public static function getForm($params) {
        return $params;
    }

    public static function getEmailAjax() {
        
        $input = Factory::getApplication()->input;

        return $input->get('email');
    }

}