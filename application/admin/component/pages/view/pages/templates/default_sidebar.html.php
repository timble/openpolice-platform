<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Menus') ?></h3>
<?= import('com:pages.view.menus.list.html', array('state' => $state, 'menus' => object('com:pages.model.menus')->getRowset())); ?>
