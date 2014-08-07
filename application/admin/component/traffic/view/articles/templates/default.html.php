<?
/**
 * Belgian Police Web Platform - Traffic Component
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

<ktml:module position="sidebar">
    <?= import('default_sidebar.html'); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
	<?= import('default_scopebar.html'); ?>
	<table>
	<thead>
		<tr>
			<th width="10">
				<?= helper( 'grid.checkall'); ?>
			</th>
            <th width="1"></th>
			<th>
				<?= helper('grid.sort', array('column' => 'title')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'start_on', 'title' => 'Date')) ?>
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
			<td style="white-space:nowrap;">
				<a href="<?= route( 'view=article&task=edit&id='.$article->id ); ?>">
					<?= $article->title ?>
				</a>
			</td>
			<td>
                <?= helper('date.format', array('date'=> $article->start_on, 'format' => translate('DATE_FORMAT_LC3'))) ?>
                <?= $article->end_on ? ' - '.helper('date.format', array('date'=> $article->end_on, 'format' => translate('DATE_FORMAT_LC3'))) : ''; ?>
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