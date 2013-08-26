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
    <h1><?php echo escape($params->get('page_title')); ?></h1>
</div>

<?= include('com:questions.view.questions.default_search.html') ?>

<ul class="nav nav-pills nav-stacked column--triple">
    <? foreach ($categories as $category): ?>
        <li>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>

<?= include('com:questions.view.questions.default_contact.html') ?>