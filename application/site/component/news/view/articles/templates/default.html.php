<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<ktml:module position="left">
    <?= @template('default_sidebar.html') ?>
</ktml:module>

<? foreach ($articles as $article) : ?>
    <div class="page-header">
        <h1><a href="<?= @helper('route.article', array('row' => $article)) ?>"><?= $article->title ?></a></h1>
        <span class="timestamp">
            <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
        </span>
    </div>

    <div class="clearfix">
        <? if($article->thumbnail): ?>
            <img class="thumbnail" src="<?= $article->thumbnail ?>" />
        <? endif; ?>

        <?= $article->introtext ?>

        <? if ($article->fulltext) : ?>
            <a href="<?= @helper('route.article', array('row' => $article)) ?>"><?= @text('Read more') ?></a>
        <? endif; ?>
    </div>
<? endforeach; ?>
<?= @helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
