<?
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.mootools'); ?>
<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />

<header class="article__header">
    <h1>
        <?= $form->title ?>
    </h1>
</header>

<?= $form->text ?>

<?= import($form->id.'.html') ?>
