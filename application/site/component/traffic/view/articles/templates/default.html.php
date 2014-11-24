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

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

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

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>

<? elseif($category->count) : ?>
    <h2 class="text-center" style="padding-top: 20px"><?= @translate('No'.' '.$category->slug) ?></h2>
<? endif ?>

<? if($category->id == '19') : ?>
<a href="./<?= $category->slug ?>/resultaten"><?= translate('Resultaten') ?></a>
<? endif ?>
