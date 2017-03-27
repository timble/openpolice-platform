<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<script inline>
    window.addEvent('domready', function(){
        /* Reset the filter values to blank */
        document.id('activities-filter').addEvent('reset', function(e){
            e.target.getElements('input').each(function(el){
                if(['city'].contains(el.name)){
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
        <div class="input-prepend">
            <span class="add-on"><?= translate('City') ?></span>
            <?= helper('com:streets.listbox.cities',
                array(
                    'autocomplete' => true,
                    'name'		   => 'city',
                    'validate'     => false,
                    'attribs'      => array('size' => null),
                )) ?>
        </div>
        <div class="btn-group">
            <input type="submit" name="submitfilter" class="btn" value="<?=translate('Filter')?>" />
            <input type="reset" name="cancelfilter" class="btn" value="<?=translate('Reset')?>" />
        </div>
    </fieldset>
</form>