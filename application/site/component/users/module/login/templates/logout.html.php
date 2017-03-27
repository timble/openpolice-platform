<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<form action="<?= helper('route.session'); ?>" method="post" name="login" id="form-login">
	<input type="hidden" name="_action" value="delete" />
    
    <?= JText::sprintf( 'HINAME', object('user')->getName()); ?>
	
	<div class="form-actions">
		<input type="submit" name="Submit" class="btn" value="<?= translate('Sign out'); ?>" />
	</div>
</form>