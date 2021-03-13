<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

// $sub_form = ModSubNewsHelper::getForm($input->get('email'));

require JModuleHelper::getLayoutPath('mod_subnews', $params->get('layout', 'default'));