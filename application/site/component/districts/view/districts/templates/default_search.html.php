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
            placeholder: "<?= @text('Search') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "?view=streets&format=json",
                dataType: 'json',
                data: function (term) {
                    return {
                        search: term, // search term
                        page_limit: 10
                    };
                },
                results: function (data) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    var results = [];
                    $jQuery.each(data.items, function(i, item) {
                        results.push(item.data);
                    });
                    return {results: results};
                }
            },
            initSelection: function(element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id=$jQuery(element).val();
                if (id!=="") {
                    $jQuery.ajax("?view=street&format=json&id="+id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.item); });
                }
            },
            formatResult: format, // omitted for brevity, see the source of this page
            formatSelection: format, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            formatInputTooShort: false,
            formatSearching: function () { return "<?= @text('Please wait') ?> ..."; },
            formatNoMatches: function () { return "<?= @text('No matches found') ?>"; }

        });
    });
</script>
    
<form action="" method="get" class="well -koowa-form">
	<fieldset>
        <div class="row-fluid">
            <div class="span9">
                <div class="control-group">
                    <label class="control-label" for="zone_street_id"><?= @text('My street') ?>:</label>
                    <div class="controls">
                        <input type="hidden" class="bigdrop" id="streets" name="street" value="<?= $state->street ?>" style="width: 100%; display: none;" tabindex="1" required>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <label class="control-label" for="number"><?= @text('My number') ?>:</label>
                    <div class="controls">
                        <input style="max-width: 90%;" type="number" name="number" value="<?= $state->number; ?>" tabindex="2" required />
                    </div>
                </div>
            </div>
        </div>
	</fieldset>
	<div class="form-actions" style="margin-bottom: 0; margin-top: 0; padding-left: 0;padding-bottom: 0;">
		<button class="btn" tabindex="3"><?= @text('Search') ?></button> <?= @text('or') ?> <a tabindex="4" href="#"><?= @text('Start over') ?></a>
	</div>
</form>
