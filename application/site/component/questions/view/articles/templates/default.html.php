<?
/**
* Belgian Police Web Platform - Questions Component
*
* @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
* @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link		http://www.police.be
*/
?>

<div class="page-header">
    <h1><?php echo @escape($params->get('page_title')); ?></h1>
</div>

<?= @template('default_search.html') ?>

<? if($state->category || $state->term) : ?>
<ul class="nav nav-pills nav-stacked">
<? foreach ($articles as $article) : ?>
    <li>
        <a href="<?= @helper('route.article', array('row' => $article)) ?>">
            <?= $article->title; ?>
        </a>
    </li>
<? endforeach; ?>
</ul>

<?= @helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>