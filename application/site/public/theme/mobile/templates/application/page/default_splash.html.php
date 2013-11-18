<script>
    $jQuery(document).ready(function() {
        function format(item) { return item.title; };
        $jQuery("#municipality").select2({
            placeholder: "<?= translate('Zoek uw woonplaats') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "?view=municipalities&format=json",
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
                    $jQuery.ajax("/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>?view=street&format=json&id="+id, {
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

<div id="wrap" class="container">
    <div class="row-fluid">
        <div class="span10 offset1">
            <div class="splash">
                <div class="logo"><img src="assets://application/images/splash-nl.jpg" /></div>
                <form action="<?= route( 'option=com_police&view=municipality' ); ?>" method="get" class="-koowa-grid">
                    <input type="text" class="bigdrop" id="municipality" placeholder="<?= translate('Zoek uw woonplaats') ?> ..." name="id" style="width: 100%">
                    <br />
                    <button class="btn">Go to site</button>
                </form>
                <div class="splash-language">
                    <a href="#">Nederlands</a>
                    <a href="#">Français</a>
                    <a href="#">Deutsch</a>
                </div>
            </div>
        </div>
    </div>

    <div id="push"></div>
</div>
<div id="footer">
    <div class="container">
        <ul class="nav nav-pills">
            <li><a href="#">Federale Politie</a></li>
            <li><a href="#">Opsporingen</a></li>
            <li><a href="#">Police On Web</a></li>
        </ul>
    </div>
</div>