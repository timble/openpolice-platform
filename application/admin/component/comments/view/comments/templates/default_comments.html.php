<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? foreach ($comments as $comment) : ?>
<tr>
	<td align="center">
		<?= helper('grid.checkbox', array('row' => $comment)); ?>
	</td>
	<td>
		<a href="<?= route('view=comment&table='.$comment->table."&row=".$comment->row); ?>">
			<?= escape($comment->table); ?>
		</a>
	</td>
	<td>
		<a href="<?= route('view=comment&table='.$comment->table."&row=".$comment->row); ?>">
			<?= escape($comment->row); ?>
		</a>
	</td>
	<td>
		<a href="<?= route('view=tag&id='.$comment->id); ?>">
			<?= escape($comment->created_by); ?>
		</a>
	</td>
	<td>
		<a href="<?= route('view=tag&id='.$comment->id); ?>">
			<?= escape($comment->text); ?>
		</a>
	</td>
</tr>
<? endforeach; ?>