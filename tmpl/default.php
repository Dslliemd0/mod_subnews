<?php

defined('_JEXEC') or die;

?>



<form id="subscribe_email">
    <label for="subscribe-email"><?php echo JText::_('MOD_SUBNEWS_DEFAULT_EMAIL_LABEL'); ?></label>
	<input id="subscribe-email" type="email" name="email" class="input-email" placeholder="<?php echo JText::_('MOD_SUBNEWS_DEFAULT_EMAIL_PLACEHOLDER'); ?>" />
    <?php echo JHtml::_('form.token'); ?>
    <div id="form-email-submit" class="control-group">
        <div class="controls">
            <button type="submit" name="Submit" class="btn btn-primary login-button"><?php echo JText::_('MOD_SUBNEWS_DEFAULT_SUBMIT'); ?></button>
        </div>
    </div>
</form>
<div id="results"></div>