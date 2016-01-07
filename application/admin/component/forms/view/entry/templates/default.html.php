<?
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" id="form-form" class="-koowa-form">
    <div class="main">
        <div class="title">
            <?= $entry->form ?>
        </div>

        <div class="scrollable">
            <dl>
                <dt><?= translate('Name') ?></dt>
                <dd><?= $entry->name ?></dd>

                <dt><?= translate('Email') ?></dt>
                <dd><?= $entry->email ?></dd>

                <? foreach(json_decode($entry->text) as $key => $value) : ?>
                <dt><?= $key ?></dt>
                <dd><?= $value ?></dd>
                <? endforeach ?>
            </dl>
        </div>
    </div>
</form>