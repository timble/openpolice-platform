<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $email = str_replace("@", "&#64;", $zone->email) ?>
<? $email = str_replace(".", "&#46;", $email) ?>

<div class="well well--small text-center">
    <?= translate('Je vraag blijft onbeantwoord? Contacteer ons via') ?> <a href="mailto:<?= $email ?>"><?= $email ?></a> <?= translate('of') ?> <span class="nowrap"><?= $zone->phone_information ?></span>.
</div>
