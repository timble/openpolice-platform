<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= $article->title ?></title>

<div class="article vevent">
    <header class="article__header">
        <h1 class="summary"><?= $article->title ?></h1>
        <div class="timestamp">
            <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
        </div>
    </header>

    <? if($article->isStreetable()) : ?>
        <? if(count($streets = $article->getStreets())) : ?>
            <? if($article->text) : ?>
            <div class="well" style="float: right; margin-left: 30px">
                <strong><?= translate('Streets') ?>:</strong>
            <? endif ?>
                <ul>
                <? foreach ($streets as $street) : ?>
                    <li><?= $street->street ?></li>
                <? endforeach; ?>
                </ul>
            <? if($article->text) : ?>
            </div>
            <? endif ?>
        <? endif ?>
    <? endif ?>

    <? if($article->text) : ?>
        <?= $article->text ?>
    <? endif ?>
</div>