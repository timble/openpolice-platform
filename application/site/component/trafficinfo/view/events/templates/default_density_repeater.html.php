<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $type = object('com:jams.model.type')->set('id', $density->type)->getRow()->title ?>
<? $from = object('com:jams.model.place')->set('id', $density->start)->getRow()->title ?>
<? $till = object('com:jams.model.place')->set('id', $density->end)->getRow()->title ?>

<?= $type.' '.translate('from').' '.$from.' '.translate('till').' '.$till ?>