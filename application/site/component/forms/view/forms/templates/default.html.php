<?
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ul>
<? foreach ($forms as $form) : ?>
    <li><a href="<?= helper('route.form', array('row' => $form)); ?>"><?= escape($form->title) ?></a></li>
<? endforeach; ?>
</ul>
