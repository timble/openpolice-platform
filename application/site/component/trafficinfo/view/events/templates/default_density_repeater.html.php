<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $type = @object('com:jams.model.type')->set('id', $density->type)->getRow()->title ?>
<? $from = @object('com:jams.model.place')->set('id', $density->start)->getRow()->title ?>
<? $till = @object('com:jams.model.place')->set('id', $density->end)->getRow()->title ?>

<?= $type.' '.@text('from').' '.$from.' '.@text('till').' '.$till ?>