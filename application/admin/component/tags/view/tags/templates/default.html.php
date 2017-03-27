<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
            <tr>
                <th width="10">
                    <?= helper('grid.checkall'); ?>
                </th>
                <th>
                    <?= helper('grid.sort', array('column' => 'title')); ?>
                </th>
                <th>
                    <?= helper('grid.sort', array('column' => 'count')); ?>
                </th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <td colspan="4">
                    <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
                </td>
            </tr>
        </tfoot>
        
        <tbody>        
            <? foreach ($tags as $tag) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $tag)); ?>
                </td>
                <td>
                    <a href="<?= route('view=tag&id='.$tag->id); ?>">
                        <?= escape($tag->title); ?>
                    </a>
                </td>
                <td>
                    <?= escape($tag->count); ?>
                </td>
            </tr>
            <? endforeach; ?>	
            <? if (!count($tags)) : ?>
            <tr>
                <td colspan="4" align="center">
                    <?= translate('No items found'); ?>
                </td>
            </tr>
            <? endif; ?>
        </tbody>
    </table>
</form>