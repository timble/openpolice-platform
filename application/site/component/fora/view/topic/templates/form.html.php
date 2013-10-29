<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title><?= !$topic->isNew() ? $topic->title : 'New Topic' ?></title>

<?= helper('behavior.mootools'); ?>
<?= helper('behavior.keepalive'); ?>

<? if (object('component')->getController()->canEdit()) : ?>
    <?= helper('behavior.inline_editing'); ?>
<? endif;?>

<!--
<script src="assets://js/koowa.js"/>
-->

<div class="btn-toolbar">
    <ktml:toolbar type="actionbar">
</div>
<form action="<?=route('option=com_fora&view=topic')?>" method="post" id="topic-form" class="-koowa-form">
    <input type="hidden" name="fora_forum_id" value="<?=$state->forum;?>">
    <article <?= !$topic->published ? 'class="topic-unpublished"' : '' ?>>
        <div class="main">
            <div class="title">
                <input class="required" type="text" name="title" maxlength="255" value="<?= $topic->title ?>" placeholder="<?= translate('Title') ?>" />
            </div>

            <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $topic->text,'toolbar'=> 'basic')) ?>
        </div>
    </article>
</form>