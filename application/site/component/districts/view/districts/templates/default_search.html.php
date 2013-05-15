<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<style src="media://districts/select2/select2.css" />
<script src="media://districts/select2/select2.min.js" />

<script>
    $jQuery(document).ready(function() {

    	function format(item) { return item.title; };

        $jQuery("#streets").select2({
                placeholder: "Search for your street",
                minimumInputLength: 1,
                ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                    url: "?view=streets&format=json",
                    dataType: 'json',
                    data: function (term, page) {
                        return {
                            search: term, // search term
                            page_limit: 10
                        };
                    },
                    results: function (data, page) { // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to alter remote JSON data
                        var results = [];
                        $jQuery.each(data.items, function(i, item) {
                            results.push(item.data);
                        });
                        return {results: results};
                    }
                },
                formatResult: format, // omitted for brevity, see the source of this page
                formatSelection: format, // omitted for brevity, see the source of this page
                dropdownCssClass: "bigdrop" // apply css that makes the dropdown taller
            });

    });
</script>
    
<form action="" method="get" class="well">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="zone_street_id"><?= @text('Enter the first letters of your street and select your street from the list') ?>:</label>
			<div class="controls">
				<input type="hidden" class="bigdrop" id="streets" name="street" style="width: 100%; display: none;" tabindex="2">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="number"><?= @text('Enter your number') ?>:</label>
			<div class="controls">
				<input type="text" name="number" class="required" id="number" size="10" maxlength="4" value="<?= $state->number; ?>" tabindex="2" />
			</div>
		</div>
	</fieldset>
	<div class="form-actions" style="margin-bottom: 0; padding-left: 0;padding-bottom: 0;">
		<button class="btn" tabindex="3"><?= @text('Search') ?></button> <?= @text('or') ?> <a tabindex="4" href="#"><?= @text('Start over') ?></a>
	</div>
</form>
