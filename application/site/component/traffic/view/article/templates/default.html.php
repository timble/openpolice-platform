<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="page-header">
	<h1><?= $article->title ?></h1>
    <?= @text('From').' '.@helper('date.format', array('date'=> $article->start_on, 'format' => JText::_('DATE_FORMAT_LC3'))).' '.@text('till').' '.@helper('date.format', array('date'=> $article->end_on, 'format' => JText::_('DATE_FORMAT_LC3'))) ?>
</div>

<div class="well well-small">
    <ul>
        <? foreach ($streets as $street) : ?><li><?= $street->street ?></li><? endforeach; ?>
    </ul>
</div>

<? if($article->text) : ?>
    <?= $article->text ?>
<? endif ?>
