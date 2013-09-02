<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

<style src="assets://districts/select2/select2.css" />
<script src="assets://districts/select2/select2.min.js" />

<script>
    $jQuery(document).ready(function() {
        function format(item) { return item.title; };
        $jQuery("#autocomplete__streets").select2({
            placeholder: "<?= translate('Search your street') ?> ...",
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
                    $jQuery.ajax("?view=street&format=json&street="+id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.item); });
                }
            },
            formatResult: format, // omitted for brevity, see the source of this page
            formatSelection: format, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            formatInputTooShort: false,
            formatSearching: function () { return "<?= translate('Please wait') ?> ..."; },
            formatNoMatches: function () { return "<?= translate('No matches found') ?>"; }

        });
    });
</script>

<div class="well">
    <form action="" method="get" class="-koowa-form">
        <div class="form__right">
            <button class="btn btn-primary btn-block" tabindex="2"><?= translate('Search') ?></button>
        </div>
        <div class="form__left">
            <input type="text" class="bigdrop" id="autocomplete__streets" placeholder="<?= @translate('Search your street') ?> ..." tabindex="1" name="street" value="<?= $state->street ?>">
        </div>
    </form>
</div>