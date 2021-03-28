<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

// $sub_form = ModSubNewsHelper::getForm($input->get('email'));

$doc = JFactory::getDocument();

$js = <<<JS
(function ($) {
    $(document).on('click', 'button[type=submit]', function () {
        let value   = $('input[name=email]').val(),
            request = {
                    'option' : 'com_ajax',
                    'module' : 'subnews',
                    'data'   : {
                        form: $('#subscribe_email').serializeArray()
                    },
                    'format' : 'raw'
                };
        $.ajax({
            type   : 'POST',
            data   : request,
            success: function (response) {
                $('#subscribe_email').remove();
                $('#results').html(response);
            },
            error: function() {
                $('#subscribe_email').remove();
                $('#results').html(response);
            }
        });
        return false;
    });
})(jQuery)
JS;

$doc->addScriptDeclaration($js);

require JModuleHelper::getLayoutPath('mod_subnews', $params->get('layout', 'default'));