<?
/**
 * Belgian Police Web Platform - Questions Component
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

        $jQuery("#terms").select2({
            placeholder: "Zoek op een kernwoord",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "?view=terms&format=json",
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

<form action="<?=@route('option=com_questions&view=articles')?>" method="get" class="well">
    <fieldset>
        <div class="control-group">
            <div class="controls">
                <input type="hidden" class="bigdrop" id="terms" name="term" style="width: 70%; display: none;" tabindex="1">
                <button class="btn" tabindex="2" style="margin-left: 20px"><?= @text('Search') ?></button>
            </div>
        </div>
    </fieldset>
</form>