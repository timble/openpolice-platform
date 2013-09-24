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
                    <strong>Filetype!</strong> We only accept a <a href="http://en.wikipedia.org/wiki/Comma-separated_values">CSV (wikipedia.com)</a> file.<br />
                    <strong>Columns!</strong> The first row must contain the column names as indicated below.
                </div>
                </fieldset>
            <fieldset>
                <legend>Example</legend>
                <?// import('default_'.$state->table.'.html') ?>
            </fieldset>
        </div>
    </div>
</form>