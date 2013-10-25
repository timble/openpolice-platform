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

<h1 class="article__header"><?= $category->title ?></h1>

<?= $category->description ?>

<table class="table table-striped">
    <tbody>
    <? foreach ($articles as $article) : ?>
        <tr>
            <td style="width: 100%">
                <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= $article->title ?></a>
                <span style="float: right;"><?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?></span><br />
                <small>
                    <? if($streets = $this->getObject('com:traffic.model.streets')->article($article->id)->getRowset()->street) : ?>
                        <?= implode(", ", $streets) ?>
                    <? else : ?>
                        <?= translate('Territory Police').' '.object('com:police.model.zone')->id(object('application')->getCfg('site' ))->getRow()->title ?>
                    <? endif ?>
                </small>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>