<?
/**
* Belgian Police Web Platform - Questions Component
*
* @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
* @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link		http://www.police.be
*/
?>

<ktml:module position="left">
    <?= import('default_categories.html', array('categories' => $categories, 'selected' => $state->category, 'class' => 'nav nav-tabs nav-stacked')) ?>
</ktml:module>

<title content="replace"><?= escape(translate($params->get('page_title'))); ?></title>

<h1 class="article__header"><?= escape(translate($params->get('page_title'))); ?></h1>

<? if(!$state->category) : ?>
    <?= import('default_search.html') ?>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<ul class="nav nav-pills nav-stacked">
<? foreach ($questions as $question) : ?>
    <li>
        <a href="<?= helper('route.question', array('row' => $question)) ?>">
            <?= $question->title ?>
        </a>
    </li>
<? endforeach; ?>
</ul>
<? else : ?>
    <?= import('default_categories.html', array('categories' => $categories, 'selected' => $state->category, 'class' => 'nav nav-pills nav-stacked column--double')) ?>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>

<?= import('default_contact.html') ?>
