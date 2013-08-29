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
    <?= import('com:police.view.page.homepage_shortcuts.html', array('class' => 'sidebar__element')) ?>
</ktml:module>

<? foreach ($articles as $article) : ?>
    <article>
        <? $link = helper('route.article', array('row' => $article)); ?>
        <header>
            <h1><a href="<?= $link ?>"><?= $article->title ?></a></h1>
            <div class="timestamp">
                <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
            </div>
        </header>

        <? if($article->thumbnail): ?>
            <a href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array('row' => $article)) ?>
            </a>
        <? endif; ?>

        <?= $article->introtext ?>

        <? if ($article->fulltext) : ?>
            <a href="<?= $link ?>"><?= translate('Read more') ?></a>
        <? endif; ?>
    </article>
<? endforeach; ?>
<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
