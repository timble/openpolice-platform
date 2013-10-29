<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title content="replace"><?= $topic->title ?></title>

<article <?= !$topic->published ? 'class="unpublished"' : '' ?>>
    <? if (object('component')->getController()->canEdit()) : ?>
        <div class="btn-toolbar">
            <ktml:toolbar type="actionbar">
        </div>
    <? endif; ?>
    <div class="page-header">
        <h1><?= $topic->title ?></h1>
    </div>

    <?=$topic->text;?>
</article>

<?= object('com:fora.controller.comment')->row($topic->id)->sort('created_on')->render(array('identifier' => 'fora'));?>


