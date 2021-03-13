<?php

defined('_JEXEC') or die;

?>

<script type="text/javascript">
let jQueryEmail = jQuery.noConflict();
jQueryEmail(document.body).on('submit', '#subscribe_email', function(e) {
    e.preventDefault();
    
    let params = jQueryEmail('#subscribe_email').serialize();
	jQueryEmail.ajax({
		type: 'GET',
		url: `index.php?option=com_ajax&module=subnews&format=raw&method=getemail&${params}`,
		success: function(response) {
            jQueryEmail('#subscribe_email').remove();
			jQueryEmail('#results').html(`<p>Thank You<br />${response}</p>`);
		},
		error: function() {
            jQueryEmail('#subscribe_email').remove();
			jQueryEmail('#results').html('<p class="error">An error was encountered while retrieving email.</p>');
		}
	});  
});</script>

<form action="" method="post" id="subscribe_email">
    <label for="subscribe-email"><?php echo JText::_('MOD_SUBNEWS_EMAIL'); ?></label>
	<input id="subscribe-email" type="email" name="email" class="input-email" placeholder="<?php echo JText::_('MOD_SUBNEWS_YOUR_EMAIL'); ?>" />
    <?php echo JHtml::_('form.token'); ?>
    <div id="form-email-submit" class="control-group">
        <div class="controls">
            <button type="submit" name="Submit" class="btn btn-primary login-button"><?php echo JText::_('MOD_SUBNEWS_SUBSCRIBE'); ?></button>
        </div>
    </div>
</form>
<div id="results"></div>