<?
/**
* Belgian Police Web Platform - Questions Component
*
* @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
* @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link		http://www.police.be
*/
?>

<? if(!$state->category) : ?>
    <div class="page-header">
        <h1><?php echo escape($params->get('page_title')); ?></h1>
    </div>

    <?= import('default_search.html') ?>
<? else : ?>
    <div class="page-header">
        <h1><?php echo escape($category->title); ?></h1>
    </div>

    <title content="replace"><?= $category->title ?></title>
<? endif ?>

<? if(!$state->category AND !$state->searchword) : ?>
<?= import('com:questions.view.categories.list.html', array('categories' => object('com:questions.model.categories')->table('questions')->published(true)->sort('title')->getRowset())) ?>
<? endif ?>

<? if($state->category AND !$state->searchword) : ?>
<ul class="nav nav-pills nav-stacked">
<? foreach ($questions as $question) : ?>
    <li>
        <a href="<?= helper('route.question', array('row' => $question)) ?>">
            <?= $question->title; ?>
        </a>
    </li>
<? endforeach; ?>
</ul>
<? endif ?>

<? if($state->searchword) : ?>
<? foreach ($questions as $question): ?>
<article>
    <div class="page-header">
        <h1>
            <a href="<?= helper('route.question', array('row' => $question)) ?>">
                <?= @highlight($question->title) ?>
            </a>
        </h1>
    </div>

    <?= @highlight($question->text) ?>
</article>
<? endforeach ?>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>

<?= import('default_contact.html') ?>
