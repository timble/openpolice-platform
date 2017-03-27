<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= escape($article->title) ?></title>

<article <?= !$article->published ? 'class="article-unpublished"' : '' ?>>
    <header>
	    <? if (object('component')->getController()->canEdit()) : ?>
        <div class="btn-toolbar">
            <ktml:toolbar type="actionbar">
        </div>
	    <? endif; ?>
	    <h1><?= escape($article->title) ?></h1>
	    <?= helper('date.timestamp', array('row' => $article, 'show_modify_date' => false)); ?>
	    <? if (!$article->published) : ?>
	    <span class="label label-info"><?= translate('Unpublished') ?></span>
	    <? endif ?>
	    <? if ($article->access) : ?>
	    <span class="label label-important"><?= translate('Registered') ?></span>
	    <? endif ?>
	</header>

    <?= helper('com:police.image.thumbnail', array(
        'attachment' => $article->attachments_attachment_id,
        'attribs' => array('width' => '200', 'align' => 'right', 'class' => 'thumbnail'))) ?>

    <? if($article->fulltext) : ?>
        <div class="article__introtext">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <?= import('com:tags.view.tags.default.html') ?>
    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>