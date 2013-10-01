<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<ktml:module position="left">
    <?= import('com:about.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= $article->title ?></title>

<article <?= !$article->published ? 'class="article-unpublished"' : '' ?>>
    <h1><?= $article->title ?></h1>

    <?= helper('com:attachments.image.thumbnail', array('row' => $article)) ?>

    <? if($article->fulltext) : ?>
        <div class="article__introtext">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <? // import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>