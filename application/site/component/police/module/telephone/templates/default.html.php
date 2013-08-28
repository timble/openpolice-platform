<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= translate('Call'); ?> <strong><a href="tel:101">101</a></strong> <?= translate('in emergency'); ?> <?= translate('else'); ?> <strong><a href="tel:<?= $telephone->telephone; ?>"><?= $telephone->telephone; ?></a></strong>