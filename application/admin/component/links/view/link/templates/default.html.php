<?
/**
 * Belgian Police Web Platform - Links Component
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

<form action="" method="post" id="link-form" class="-koowa-form">
    <div class="main">
        <div class="title">
            <input disabled class="required" type="text" name="title" maxlength="255" value="<?= escape($link->title) ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on">URL</span>
                <input disabled type="text" name="slug" maxlength="255" value="<?= escape($link->url) ?>" />
            </div>
        </div>

        <div class="scrollable">
            <fieldset>
                <legend><?= translate('Mentioned on') ?></legend>
                <table class="table table--striped">
                    <thead>
                    <tr>
                        <th><?= translate('Title') ?></th>
                        <th><?= translate('Status') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach($childs AS $child) : ?>
                        <tr>
                            <td><?= $child->child_title ?><br />
                                <small><a target="_blank" href="<?= $child->child_url ?>"><?= $child->child_url ?></a></small></td>
                            <td><?= $child->child_status ?></td>
                        </tr>
                    <? endforeach ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>