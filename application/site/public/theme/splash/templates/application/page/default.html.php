<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= @template('page_head.html') ?>

<script>
    $jQuery(document).ready(function() {

    	function format(item) { return item.title; };

        $jQuery("#municipality").select2({
                placeholder: "Zoek uw woonplaats ...",
                minimumInputLength: 1,
                ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                    url: "?view=municipalities&format=json",
                    dataType: 'jsonp',
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

<body>

<div id="wrap" class="container">
	<div class="row-fluid">
        <div class="span10 offset1">
            <div class="splash">
                <div class="logo"><img src="media://application/images/splash-nl.jpg" /></div>
                <form action="<?= @route( 'option=com_police&view=municipality' ); ?>" method="get" class="-koowa-grid">
                    <input name="id" type="hidden" class="bigdrop" id="municipality" style="display: none; width: 100% ">
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

</body>
</html>