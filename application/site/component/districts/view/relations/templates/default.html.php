<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= import('com:districts.view.search.default.html'); ?>

<? if ($state->street) : ?>
    <ul>
        <? foreach ($relations as $relation) : ?>
        <li>
            <a href="<?= helper('route.district', array('row' => $relation)) ?>">
                <?= $relation->street ?> <?= helper('string.street', array('row' => $relation)) ?>
            </a>
        </li>
        <? endforeach; ?>
    </ul>
    <? if(!count($relations)) : ?>
        <h2 role="alert" style="text-align: center;margin: 60px 0"><?= translate('No neighbourhood officer found') ?>.</h2>
        <? $zone = object('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow() ?>
        <? $email = str_replace("@", "&#64;", $zone->email) ?>
        <? $email = str_replace(".", "&#46;", $email) ?>

        <div class="well well--small text-center">
            <?= translate('Contact us at') ?> <a href="mailto:<?= $email ?>"><?= $email ?></a> <?= translate('or') ?> <span class="nowrap"><?= $zone->phone_information ?></span>.
        </div>
    <? endif ?>

    <?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>