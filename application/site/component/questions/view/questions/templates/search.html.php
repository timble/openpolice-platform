<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= escape(translate($params->get('page_title'))); ?></title>

<h1 class="article__header"><?= escape(translate($params->get('page_title'))); ?></h1>

<?= import('default_search.html') ?>

<? if(count($questions)) : ?>
    <ul class="nav nav--pills">
        <? foreach ($questions as $question) : ?>
            <li>
                <a href="<?= helper('route.question', array('row' => $question)) ?>">
                    <?= $question->title ?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
<? else : ?>
    <h2 id="no-results"><?= translate('No results found') ?>.</h2>
<? endif ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>

<?= import('default_contact.html') ?>

<script data-inline>
    if(document.getElementById('no-results')) {
        ga('send', 'event', 'Questions','No results found','<?= $state->searchword ?>');
    }
</script>
