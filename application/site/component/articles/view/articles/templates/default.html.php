<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= $category->title ?></title>

<? if ($params->get('show_feed_link', 1) == 1) : ?>
<link href="<?= route('format=rss') ?>" rel="alternate" type="application/rss+xml" />
<? endif; ?>

<? foreach ($articles as $article): ?>
    <?= import('default_item.html', array('article' => $article)) ?>
<? endforeach; ?>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>

