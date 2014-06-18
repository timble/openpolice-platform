<?
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<script src="assets://js/koowa.js" />
<?= helper('behavior.validator'); ?>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form" enctype="multipart/form-data">
    <div class="main">
        <div class="scrollable">
            <fieldset>
                <legend>Upload</legend>
                <input type="hidden" name="table" value="<?= $state->table ?>" />

                <input type="file" name="file" />

                <div class="alert alert-error">
                    <strong>Filetype!</strong> We only accept <a href="https://en.wikipedia.org/wiki/Comma-separated_values">CSV (wikipedia.com)</a> or <a href="https://en.wikipedia.org/wiki/XML">XML</a> files.<br />
                    <strong>Columns!</strong> The first row must contain the column names as indicated below.
                </div>
            </fieldset>
            <?= import('default_'.$state->table.'.html') ?>
        </div>
    </div>
</form>