<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

// $sub_form = ModSubNewsHelper::getForm($input->get('email'));

$doc = JFactory::getDocument();

$js = <<<JS

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

(function ($) {
    $(document).on('click', 'button[type=submit]', function () {
        let value   = $('input[name=email]').val();
        if (isEmail(value)) {
            let request = {
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
        } else {
            $('input[name=email]').addClass('invalid-email')
        }
    });
})(jQuery)
JS;

$doc->addScriptDeclaration($js);

require JModuleHelper::getLayoutPath('mod_subnews', $params->get('layout', 'default'));