<?
    $zone = object('com:police.model.zone')->id($site)->getRow();
?>

<script>
    $jQuery(document).ready(function() {
        function format(item) { return item.title; };
        $jQuery("#autocomplete__streets--footer").select2({
            placeholder: "<?= translate('Search your street') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>?view=streets&format=json",
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

<div id="wrap">
    <div class="container container__header">
        <div class="logo" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/<?= $site ?>">
                <img width="160" height="42" itemprop="logo" alt="<?= translate('Police') ?> logo" src="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.jpg" />
                <div><?= escape($zone->title); ?></div>
            </a>
        </div>

        <div class="navigation">
            <span class="slogan">
                <?= JText::sprintf('Call for urgent police assistance', '101', '101') ?>.
                <?= JText::sprintf('No emergency, just police', escape(str_replace(' ', '', $zone->phone_emergency)), escape($zone->phone_emergency)) ?>.
            </span>
            <div class="navbar">
                <div class="navbar__handlebar">
                    <div class="navbar__handle">&equiv;</div>
                    <a class="navbar__logo" href="/<?= $site ?>">
                        <?= translate('Police') ?>
                        <?= escape($zone->title); ?>
                    </a>
                </div>
                <ktml:modules position="navigation">
                    <ktml:modules:content>
                </ktml:modules>
            </div>
        </div>
    </div>

    <div class="container container__banner">
        <img width="890" height="110" src="assets://application/images/banners/<?= $site ?>.jpg" alt="<?= translate('Police') ?> <?= escape($zone->title); ?> banner" />
    </div>

    <ktml:modules position="breadcrumbs">
        <div class="container container__breadcrumb">
            <ktml:modules:content>
        </div>
    </ktml:modules>

    <div class="container container__content <?= $extension ?>">
        <ktml:modules position="left">
            <aside class="sidebar">
                <ktml:modules:content>
            </aside>
        </ktml:modules>

        <div class="<?= ($extension == 'police' OR $extension == 'files') ? 'homepage' : 'component' ?>">
            <ktml:content>
        </div>
    </div>

    <div class="container container__footer">
        <div class="row">
            <div class="footer__news">
                <h3><?= translate('Latest news') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <div class="footer__districts">
                <h3><?= translate('Your district officer') ?></h3>
                <form action="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>" method="get" class="-koowa-form">
                    <div class="control-group">
                        <div class="controls">
                            <input type="text" class="bigdrop" id="autocomplete__streets--footer" placeholder="<?= translate('Search your street') ?> ..." name="street" value="<?= @$_COOKIE ['district_street'] ?>">
                        </div>
                    </div>
                    <button class="button button--primary"><?= translate('Search') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container container__copyright">
        <div class="copyright--left">
            <? if($zone->twitter) : ?>
                <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a> |
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a> |
            <? endif ?>
            <a href="/<?= $site ?>/downloads">Downloads</a>
        </div>
        <div class="copyright--right">
            © 2013 <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
            <a href="http://www.belgium.be">Belgium.be</a>
        </div>
    </div>
</div>