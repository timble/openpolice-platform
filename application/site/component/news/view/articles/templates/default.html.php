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
    <?= @template('com:police.view.page.homepage_shortcuts.html') ?>
</ktml:module>

<? foreach ($articles as $article) : ?>
    <? $link = @helper('route.article', array('row' => $article)); ?>
    <div class="page-header">
        <h1><a href="<?= $link ?>"><?= $article->title ?></a></h1>
        <span class="timestamp">
            <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
        </span>
    </div>

    <div class="clearfix">
        <? if($article->thumbnail): ?>
            <a href="<?= $link ?>">
                <img class="thumbnail" src="<?= $article->thumbnail ?>" />
            </a>
        <? endif; ?>

        <?= $article->introtext ?>

        <? if ($article->fulltext) : ?>
            <a href="<?= $link ?>"><?= @text('Read more') ?></a>
        <? endif; ?>
    </div>
<? endforeach; ?>
<?= @helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
