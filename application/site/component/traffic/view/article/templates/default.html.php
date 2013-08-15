<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<article>
    <div class="page-header">
        <h1><?= $article->title ?></h1>
        <div class="timestamp">
            <?= @helper('date.format', array('date'=> $article->start_on, 'format' => JText::_('DATE_FORMAT_LC3'))) ?>
            <?= $article->end_on ? @text('till').' '.@helper('date.format', array('date'=> $article->end_on, 'format' => JText::_('DATE_FORMAT_LC3'))) : '' ?></td>
        </div>
    </div>

    <div class="row-fluid">
        <? if($article->text) : ?>
        <div class="span8">
            <?= $article->text ?>
        </div>
        <? endif ?>
        <div class="span4">
            <? if($article->isStreetable()) : ?>
                <div class="well well-small">
                    <ul>
                        <? foreach ($article->getStreets() as $street) : ?><li><?= $street->street ?></li><? endforeach; ?>
                    </ul>
                </div>
            <? endif ?>
        </div>
    </div>
</article>