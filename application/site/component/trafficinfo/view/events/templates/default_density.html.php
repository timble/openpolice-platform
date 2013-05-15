<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $densities = $event->densities ?>
<ul>
	<li><?= @template('default_density_repeater.html', array('name' => '1', 'density' => $densities->one)); ?></li>
	<li><?= @template('default_density_repeater.html', array('name' => '2', 'density' => $densities->two)); ?></li>
	<li><?= @template('default_density_repeater.html', array('name' => '3', 'density' => $densities->three)); ?></li>
	<li><?= @template('default_density_repeater.html', array('name' => '4', 'density' => $densities->four)); ?></li>
</ul>