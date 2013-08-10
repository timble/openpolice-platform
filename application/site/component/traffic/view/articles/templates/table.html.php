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
    <h1><?php echo @escape($params->get('page_title')); ?></h1>
</div>

<?= $category->description ?>

<table class="table table-striped">
    <tbody>
    <? foreach ($articles as $article) : ?>
        <tr>
            <td style="width: 100%"><a href="<?= @helper('route.article', array('row' => $article)) ?>"><?= $article->title ?></a></td>
            <td nowrap>
                <?= @helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<?= @helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>