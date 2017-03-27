<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h4><?= translate( 'Untranslated Strings' ) ?></h4>
<pre>
<? foreach ($strings as $key => $occurance) : ?>
	<? foreach ( $occurance as $i => $info) : ?>
	<?	
		$class	= $info['class'];
		$func	= $info['function'];
		$file	= $info['file'];
		$line	= $info['line'];
	?>
	<?= strtoupper( $key )."\t$class::$func()\t[$file:$line]\n"; ?>
	<? endforeach; ?>
<? endforeach; ?>
</pre>