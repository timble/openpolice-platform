<script data-inline>
    $jQuery(document).ready(function() {
        function format(item) { return item.title; };
        $jQuery("#autocomplete__streets").select2({
            placeholder: "<?= translate('Search your street') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "?option=com_streets&view=streets&format=json",
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
                        results.push({"title": item.data.title, "id": item.data.streets_street_identifier});
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
                    $jQuery.ajax("?option=com_streets&view=street&format=json&id="+id, {
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

<input type="text" id="autocomplete__streets" placeholder="<?= @translate('Search the street') ?> ..." name="streets" value="<?= $selected ?>" style="width: 100%">