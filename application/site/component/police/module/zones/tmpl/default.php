<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<form action="<?= route( 'option=com_police&view=municipality' ); ?>" method="get" class="-koowa-grid">
	<?= helper('listbox.default', array('model' => 'municipalities', 'text' => 'title', 'autocomplete' => true, 'name' => 'id', 'attribs' => array('placeholder' => 'Leuven'))) ?>
	<br />
	<button>Woonplaats zoeken</button>
</form>