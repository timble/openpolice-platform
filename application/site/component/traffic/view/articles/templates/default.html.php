<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h1 class="article__header"><?php echo escape($params->get('page_title')); ?></h1>

<? foreach ($articles as $article) : ?>
    <h2>
        <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
        <small><?= $article->title ?></small>
    </h2>

    <? if($article->text) : ?>
        <?= $article->text ?>
    <? endif ?>

    <? if($streets = $this->getObject('com:traffic.model.streets')->article($article->id)->getRowset()->street) : ?>
        <?= implode(", ", $streets) ?>
    <? else : ?>
        <?= translate('Grondgebied van Politie').' '.object('com:police.model.zone')->id(object('application')->getCfg('site' ))->getRow()->title ?>
    <? endif ?>
<? endforeach; ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>