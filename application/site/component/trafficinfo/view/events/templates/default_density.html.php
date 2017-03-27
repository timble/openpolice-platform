<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $densities = $event->densities ?>
<ul>
	<li><?= import('default_density_repeater.html', array('name' => '1', 'density' => $densities->one)); ?></li>
	<li><?= import('default_density_repeater.html', array('name' => '2', 'density' => $densities->two)); ?></li>
	<li><?= import('default_density_repeater.html', array('name' => '3', 'density' => $densities->three)); ?></li>
	<li><?= import('default_density_repeater.html', array('name' => '4', 'density' => $densities->four)); ?></li>
</ul>