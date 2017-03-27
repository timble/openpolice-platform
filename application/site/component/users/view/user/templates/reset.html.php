<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?=helper('behavior.mootools')?>
<?=helper('behavior.validator')?>

<div class="page-header">
    <h1><?=translate('Password reset request');?></h1>
</div>

<p><?= translate('RESET_PASSWORD_REQUEST_DESCRIPTION');?></p>
<form action="" method="post" class="-koowa-form form-horizontal">
    <div class="control-group">
        <label class="control-label" for="email"><?= translate('E-mail') ?></label>

        <div class="controls">
            <input class="required validate-email" type="email" id="email" name="email" placeholder="E-mail"/>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?=translate('Submit');?></button>
    </div>
    <input type="hidden" name="_action" value="token"/>
</form>