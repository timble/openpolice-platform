<?
/**
* Belgian Police Web Platform - Questions Component
*
* @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
* @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link		https://github.com/belgianpolice/internet-platform
*/
?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= escape(translate($params->get('page_title'))); ?></title>

<h1 class="article__header"><?= escape(translate($params->get('page_title'))); ?></h1>

<? if(!$state->category) : ?>
    <?= import('default_search.html') ?>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<? if(count($questions)) : ?>
<ul class="nav nav--pills nav--visited">
<? foreach ($questions as $question) : ?>
    <li>
        <a href="<?= helper('route.question', array('row' => $question)) ?>">
            <?= $question->title ?>
        </a>
    </li>
<? endforeach; ?>
</ul>
    <? else : ?>
    <h2><?= translate('No results found') ?>.</h2>
    <? endif ?>
<? else : ?>
   <ul class="nav nav--pills column--double">
        <? foreach ($categories as $category): ?>
            <li>
                <a href="<?= helper('route.category', array('row' => $category)) ?>">
                    <?= $category->title ?>
                </a>
            </li>
        <? endforeach ?>
    </ul>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>

<?= import('default_contact.html') ?>
