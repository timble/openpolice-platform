<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? 
$params = new \JParameter( null, $settings->getPath() );
$params->loadArray($settings->toArray());
?>

<? if($params = $params->render('settings['.$settings->getName().']')) : ?>
	<fieldset>
	    <legend><?=  translate(ucfirst($settings->getName())); ?></legend>
		<?= $params; ?>
	</fieldset>
<? endif ?>