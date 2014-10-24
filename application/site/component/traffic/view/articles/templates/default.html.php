<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= import('com:news.view.article.metadata.html', array('article' => $category)) ?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<h1 class="article__header"><?= $category->title ?></h1>

<?= $category->description ?>

<? if(count($articles)) : ?>
<table class="table table--striped">
    <tbody>
    <? foreach ($articles as $article) : ?>
        <tr>
            <td>
                <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= escape($article->title) ?></a>
                <span style="float: right; white-space: nowrap"><?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?></span><br />
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
<? else : ?>
<h2 class="text-center" style="padding-top: 20px"><?= @translate('No').' '.strtolower($category->title) ?></h2>
<? endif ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>