<style src="media://districts/select2/select2.css" />
<script src="media://districts/select2/select2.min.js" />

<script>
    $jQuery(document).ready(function() {
        function format(item) { return item.title; };
        $jQuery("#streets_footer").select2({
            placeholder: "<?= @text('Search') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/5388/contact/je-wijkinspecteur?view=streets&format=json",
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
                    $jQuery.ajax("/5388/contact/je-wijkinspecteur?view=street&format=json&id="+id, {
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

<form action="/5388/contact/je-wijkinspecteur" method="get" class="-koowa-form">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="zone_street_id"><?= @text('Mijn straat') ?>:</label>
            <div class="controls">
                <input type="hidden" class="bigdrop" id="streets_footer" name="street" value="<?= @$_COOKIE ['district_street'] ?>" style="display: none;" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="number"><?= @text('Mijn huisnummer') ?>:</label>
            <div class="controls">
                <input type="number" name="number" value="<?= @$_COOKIE ['district_number'] ?>" required />
            </div>
        </div>
    </fieldset>
    <button class="btn"><?= @text('Search') ?></button>
</form>