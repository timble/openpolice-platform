<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($articles->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages') ?>
</ktml:module>
<? endif ?>

<form action="" method="get" class="-koowa-grid">
	<?= import('default_scopebar.html'); ?>
    <table>
	<thead>
		<tr>
			<th width="10">
				<?= helper( 'grid.checkall'); ?>
			</th>
            <th width="1"></th>
			<th width="100%">
				<?= helper('grid.sort', array('column' => 'title')) ?>
			</th>
            <th>
                <?= helper('grid.sort', array('column' => 'publish_on', 'title' => 'Published on')) ?>
            </th>
            <? if($articles->isTranslatable()) : ?>
            <th width="70">
                <?= translate('Translation') ?>
            </th>
            <? endif ?>
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
		<? foreach ($articles as $article) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $article))?>
			</td>
            <td align="center">
                <?= helper('grid.enable', array('row' => $article, 'field' => 'published')) ?>
            </td>
            <td class="ellipsis">
                <? if($article->sticky) : ?>
                    <i class="icon-star"></i>
                <? endif ?>
                <a href="<?= route( 'view=article&task=edit&id='.$article->id ); ?>">
					<?= $article->title ?>
				</a>
                <? if($article->publish_on > $now) : ?>
                <span class="label label-warning"><?= translate('Planned') ?></span>
			    <? endif ?>
            </td>
            <td>
                <?= helper('date.format', array('date'=> $article->publish_on, 'format' => 'D d/m/Y - G:i')) ?>
            </td>
            <? if($article->isTranslatable()) : ?>
            <td>
                <?= helper('com:languages.grid.status', array(
                    'status'   => $article->translation_status,
                    'original' => $article->translation_original,
                    'deleted'  => $article->translation_deleted));
                ?>
            </td>
            <? endif ?>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>