<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= helper('behavior.validator') ?>

<script inline>
window.addEvent('domready', function(){
	/* Reset the filter values to blank */
	document.id('activities-filter').addEvent('reset', function(e){
		e.target.getElements('input').each(function(el){
			if(['parent_id'].contains(el.name)){
				el.value = '';
			}
		});
		e.target.submit();
	});
});
</script>


<form action="" method="get" id="activities-filter">
    <fieldset>
        <legend><?=translate( 'Filters' )?></legend>
        <div style="padding:10px">
            <label for="user"><?=translate( 'City' )?></label>
            <div>
                <?= helper('com:police.listbox.cities',
                        array(
                            'autocomplete' => true,
                            'name'		   => 'parent_id',
                            'validate'     => false,
                            'filter'       => array('parent_id' => '0')
                        )) ?>
            </div>

            <div class="btn-group">
                <input type="submit" name="submitfilter" class="btn" value="<?=translate('Filter')?>" />
                <input type="reset" name="cancelfilter" class="btn" value="<?=translate('Reset')?>" />
            </div>
        </div>
    </fieldset>
</form>