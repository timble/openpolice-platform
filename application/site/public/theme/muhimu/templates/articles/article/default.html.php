<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title content="replace"><?= $article->title ?></title>

<? if($article->contacts_contact_id) : ?>
<ktml:module position="sidebar">
    <?= object('com:contacts.controller.contact')->layout('simple')->id($article->contacts_contact_id)->render(); ?>
</ktml:module>
<? endif ?>

<article class="article">
    <h1 class="article__header"><?= escape($article->title); ?></h1>

    <div class="article__text">
        <? if($article->attachments_attachment_id) : ?>
        <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail" href="attachments://<?= $thumbnail ?>" data-gallery="enabled">
        <?= helper('com:police.image.thumbnail', array(
            'attachment' => $article->attachments_attachment_id,
            'attribs' => array('width' => '400', 'height' => '300'))) ?>
        </a>
        <? endif ?>

        <?= $article->text ?>
    </div>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>
