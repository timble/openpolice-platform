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

<ktml:module position="sidebar">
    <section>
        <h2>Fietsendienst &amp; stallingsplaats</h2>
        <address>
            <p>
                De Vunt 2<br />
                3220 Holsbeek<br />
            </p>
            <p>
                <span>Telefoon:</span> 016 21 09 90<br />
                <span>Fax:</span> 016 21 09 89<br />
                <span>E-mail:</span> <a href="mailto:stalling@politieleuven.be">stalling@politieleuven.be</a>
            </p>
        </address>
        <p>
            Graveren van fietsen enkel op woensdag van <strong class="nowrap">13 tot 15.30</strong> uur en op donderdag van <strong class="nowrap">17 tot 19.30</strong> uur.
        </p>

        <hr class="divide divide--large" />

        <h2>Preventie</h2>
        <ul>
            <li><a href="#">Lorem ipsum dolor</a></li>
            <li><a href="#">Sit amet consectetuer adipiscing elit</a></li>
            <li><a href="#">Lorem ipsum dolor</a></li>
            <li><a href="#">Sit amet consectetuer adipiscing elit</a></li>
        </ul>
    </section>
</ktml:module>

<article <?= !$article->published ? 'class="article-unpublished"' : '' ?>>
    <header>
	    <? if (object('component')->getController()->canEdit()) : ?>
        <div class="btn-toolbar">
            <ktml:toolbar type="actionbar">
        </div>
	    <? endif; ?>
	    <h1><?= $article->title ?></h1>
	    <?= helper('date.timestamp', array('row' => $article, 'show_modify_date' => false)); ?>
	    <? if (!$article->published) : ?>
	    <span class="label label-info"><?= translate('Unpublished') ?></span>
	    <? endif ?>
	    <? if ($article->access) : ?>
	    <span class="label label-important"><?= translate('Registered') ?></span>
	    <? endif ?>
	</header>

    <?= helper('com:attachments.image.thumbnail', array(
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