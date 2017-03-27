<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div class="alert">
    <?= $message ?>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th><?= translate('Function') ?></th>
            <th><?= translate('File') ?></th>
            <th><?= translate('Line') ?></th>
        </tr>
    </thead>

    <? $j = 1; ?>
    <tbody>
    <? for( $i = count( $trace ) - 1; $i >= 0 ; $i-- ) : ?>
        <tr>
            <td><?= $j ?></td>
            <? if( isset( $trace[$i]['class'])) : ?>
            <td><?= $trace[$i]['class'].$trace[$i]['type'].$trace[$i]['function'].'()' ?></td>
            <? else : ?>
            <td><?= $trace[$i]['function'].'()' ?></td>
            <? endif; ?>

            <? if( isset( $trace[$i]['file'])) : ?>
            <td><?= $trace[$i]['file'] ?></td>
            <? else : ?>
            <td> </td>
            <? endif; ?>

            <? if( isset( $trace[$i]['line'])) : ?>
            <td><?= $trace[$i]['line']; ?></td>
            <? else : ?>
            <td> </td>
            <? endif; ?>
        </tr>
    <? $j++ ?>
    <? endfor; ?>
    </tbody>
</table>