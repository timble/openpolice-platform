<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<h3><?= $module->title ?></h3>
<p>
<?= $contact->address; ?><br />
<?= $contact->postcode; ?> <?= $contact->suburb; ?><br />
<?php if ($contact->telephone) : ?>T: <?= $contact->telephone; ?><br /><?php endif ?>
<?php if ($contact->fax) : ?>F: <?= $contact->fax; ?><?php endif ?>
</p>

<?php if($params->get('link_url')) : ?>
<p><a href="<?= $params->get('link_url'); ?>"><?= @text('More contact information') ?></a></p>
<?php endif ?>