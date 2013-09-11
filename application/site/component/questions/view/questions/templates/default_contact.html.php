<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="well well--small text-center">
    <?= translate('Je vraag blijft onbeantwoord? Contacteer ons via') ?> <a href="mailto:<?= $zone->email ?>"><?= $zone->email ?></a> <?= translate('of') ?> <span class="nowrap"><?= $zone->phone_information ?></span>.
</div>
