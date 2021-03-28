<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class ModSubNewsHelper {

    private $params = null;

    public function __construct()
    {
        $this->params = $this->getParams();
    }

    public function getParams()
    {
        $module = JModuleHelper::getModule('mod_subnews');
        $moduleParams = new JRegistry;

        if ($module->params !== '')
        {
            $moduleParams->loadString($module->params);
        }

        return $moduleParams;
    }

    public static function getAjax() {

        $helper = new ModSubNewsHelper();

        $recipient_email = $helper->getParams()->get('email');

        $input = Factory::getApplication()->input;

        $data = $input->get('data', '', 'string');

        if ($data['form'][1]['name'] != JSession::getFormToken()){die( 'Invalid Token' );}

        $subscribe_email = $data['form'][0]['value'];

        $mailer = JFactory::getMailer();

        $config = JFactory::getConfig();
        $sender = array( 
            $config->get('mailfrom'),
            $config->get('fromname') 
        );

        $mailer->setSender($sender);

        $recipient = $recipient_email;

        $mailer->addRecipient($recipient);

        $mailer->setSubject(JText::_('MOD_SUBNEWS_HELPER_EMAIL_SUBJECT'));
        $body = '<h2>' . JText::_('MOD_SUBNEWS_HELPER_EMAIL_SUBJECT') . '</h2>'
        . '<div>' . JText::_('MOD_SUBNEWS_HELPER_EMAIL_DESC') . $subscribe_email . '</div>';
        $mailer->isHtml(true);
        $mailer->Encoding = 'base64';
        $mailer->setBody($body);

        $send = $mailer->Send();
        if ($send !== true) {
            return '<div class="error">' . JText::_('MOD_SUBNEWS_HELPER_SEND_ERROR_DESC') . '</div>';
        } else {
            return '<div class="success-req">' .
                JText::_('MOD_SUBNEWS_HELPER_SEND_SUCCESS_DESC') . '</div>';
        }
    }

}