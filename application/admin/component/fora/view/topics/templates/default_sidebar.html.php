<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<h3><?= translate('Forums') ?></h3>
<?= import('com:fora.view.forums.list.html', array('forums' => object('com:fora.model.forums')->sort('title')->getRowset())); ?>