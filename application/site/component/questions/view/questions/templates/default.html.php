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

<? if($zone->id != '5396') : ?>
<?= import('default_contact.html') ?>
<? endif ?>

<script data-inline>
    if(document.getElementById('no-results')) {
        ga('send', 'event', 'Questions','No results found','<?= $state->searchword ?>');
    }
</script>
