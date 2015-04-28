<?
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.mootools'); ?>
<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />

<form action="http://police.dev/5388?option=com_forms&view=entry&layout=default" method="post" id="form-form" class="-koowa-form">
    <div class="main">
        <div class="scrollable">
            <input type="text" name="email" maxlength="60" value="" placeholder="<?= translate('Email') ?>" />
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><?= translate('Send'); ?></button>
    </div>
</form>

qsdsqd