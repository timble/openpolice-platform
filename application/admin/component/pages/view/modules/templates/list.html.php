<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<table summary="Add Module" class="table">
	<thead>
		<tr>
			<th colspan="2">
				<?= translate('Select module') ?>
			</th>
		</tr>
	</thead>
	<tbody>
	<? $i = 0; foreach($modules as $module) : ?>
		<? if(!$i%2) : ?>
			<tr valign="top">
		<? endif; ?>
		<? $last = $i+1 == count($modules) ?>

		<td width="50%">
            <a href="<?= route('view=module&layout=form&name='.$module->name.'&application='.$state->application.'&component='.$module->extensions_extension_id) ?>">
                <?= translate(escape($module->name)) ?>
            </a>
		</td>

		<? if($last) : ?> 
			<td width="50%">&nbsp;</td>
		<? endif; ?>
		
		<? if($i%2 || $last) : ?> 
			</tr>
		<? endif; ?>
	<? $i++; endforeach ?>
	</tbody>
</table>