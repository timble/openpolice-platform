
<script src="assets://application/js/jquery.js" />
<script src="assets://application/components/select2/select2.js" />
<script src="assets://application/js/ie7.js" condition="if lte IE 7" />

<script>
    $(document).ready(function() {
        function format(item) { return item.title; };
        $("#autocomplete__municipality").select2({
            placeholder: "<?= translate('Search your city') ?> ...",
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
                    $.each(data.items, function(i, item) {
                        results.push(item.data);
                    });
                    return {results: results};
                }
            },
            initSelection: function(element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id=$(element).val();
                if (id!=="") {
                    $.ajax("/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>?view=street&format=json&id="+id, {
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

<div id="wrap">
    <div class="container container__content">
        <div class="splash">
            <div class="splash__logo"><img src="assets://application/images/logo-<?= $language_short ?>.jpg" /></div>
            <div class="splash__search">
                <form action="<?= route( 'option=com_police&view=municipality' ); ?>" method="get" class="-koowa-grid">
                    <input type="text" class="bigdrop" id="autocomplete__municipality" placeholder="<?= translate('Search your city') ?> ..." name="id" style="width: 100%">
                    <div class="splash__toolbar">
                        <button class="button button--primary">Go to site</button>
                    </div>
                </form>
            </div>

            <div class="splash__languages">
                <a href="#">Nederlands</a>
                <a href="#">Français</a>
                <a href="#">Deutsch</a>
                <a href="#">English</a>
            </div>
            <div class="splash__external">
                <a href="#">Federale Politie</a>
                <a href="#">Opsporingen</a>
                <a href="#">Police On Web</a>
                <a href="#">eCops</a>
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container container__copyright">
        <div class="copyright--right">
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
            <a href="http://www.belgium.be">Belgium.be</a>
        </div>
    </div>
</div>