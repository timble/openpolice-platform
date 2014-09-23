<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<style src="/theme/mobile/components/select2/select2.css" />

<script src="/theme/mobile/components/jquery/dist/jquery.min.js" />
<script src="/theme/mobile/components/select2/select2.js" />
<script src="/theme/mobile/js/ie7.js" condition="if lte IE 7" />

<script>
    $(document).ready(function() {
        function format(item) { return item.title; };
        $("#municipality").select2({
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
            formatResult: format, // omitted for brevity, see the source of this page
            formatSelection: format, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            formatInputTooShort: false,
            formatSearching: function () { return "<?= translate('Please wait') ?> ..."; },
            formatNoMatches: function () { return "<?= translate('No matches found') ?>"; }
        });
    });
</script>

<?
$language_short = explode("-", $language);
$language_short = $language_short[0];
?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= import('page_head.html') ?>
<body id="page" class="no-js">
<script data-inline type="text/javascript" pagespeed_no_defer="">function hasClass(e,t){return e.className.match(new RegExp("(\\s|^)"+t+"(\\s|$)"))}var el=document.getElementById("page");var cl="no-js";if(hasClass(el,cl)){var reg=new RegExp("(\\s|^)"+cl+"(\\s|$)");el.className=el.className.replace(reg,"js-enabled")}</script>

<div id="wrap">
    <div class="container container__content">
        <div class="splash">
            <div class="splash__logo"><img src="assets://application/images/logo-<?= $language_short ?>.jpg" /></div>
            <div class="splash__search">
                <form action="<?= route( 'option=com_police&view=municipality' ); ?>" method="get" class="-koowa-grid">
                    <input type="text" class="bigdrop" id="municipality" placeholder="<?= translate('Search your city') ?> ..." name="id" style="width: 100%">
                    <div class="splash__toolbar">
                        <button class="button button--primary"><?= translate('Go to site') ?></button>
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

</body>
</html>