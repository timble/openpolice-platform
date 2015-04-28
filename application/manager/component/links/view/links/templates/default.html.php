<?
/**
 * Belgian Police Web Platform - Links Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <table>
        <thead>
        <tr>
            <th width="100%">
                <?= helper('grid.sort', array('column' => 'url', 'title' => 'Link')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'links')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'status')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'last_crawled_on', 'title' => 'Last crawled on')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'last_checked_on', 'title' => 'Last checked on')) ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="7">
                <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <? foreach ($links as $link) : ?>
            <tr>
                <td class="ellipsis" style="padding: 8px 10px">
                    <a href="<?= route('view=link&id='.$link->id); ?>"><?= $link->title ?><br /><small><?= $link->url ?></small></a>
                </td>
                <td>
                    <?= $link->links ?>
                </td>
                <td>
                    <?= $link->status ?>
                </td>
                <td>
                    <? if($link->last_crawled_on) : ?>
                    <?= helper('date.format', array('date'=> $link->last_crawled_on, 'format' => translate('D d.m.Y - G:i'))) ?>
                    <? endif ?>
                </td>
                <td>
                    <? if($link->last_checked_on) : ?>
                        <?= helper('date.format', array('date'=> $link->last_checked_on, 'format' => translate('D d.m.Y - G:i'))) ?>
                    <? endif ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>
