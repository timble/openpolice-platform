<?
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
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
    <input type="hidden" name="override" value="0" />
    <div class="main">
        <div class="scrollable">
            <fieldset>
                <legend>Upload</legend>
                <input type="hidden" name="table" value="<?= $state->table ?>" />

                <div>
                    <label for="file"><?= translate('File') ?></label>
                    <div>
                        <input type="file" name="file" />
                    </div>
                </div>

                <div>
                    <label for="override"><?= translate('Override') ?></label>
                    <div>
                        <input type="checkbox" name="override" value="1" />
                    </div>
                </div>

                <div class="alert alert-error">
                    <strong>Filetype!</strong> We only accept <a href="https://en.wikipedia.org/wiki/Comma-separated_values">CSV (wikipedia.com)</a> or <a href="https://en.wikipedia.org/wiki/XML">XML</a> files.<br />
                    <strong>Columns!</strong> The first row must contain the column names as indicated below.
                </div>
            </fieldset>
            <?= import('default_'.$state->table.'.html') ?>
        </div>
    </div>
</form>