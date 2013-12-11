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

<div id="wrap" class="container-fluid">
    <div class="container-header">
        <div class="row-fluid">
            <div class="span3 alpha">
                <div class="logo" itemscope itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="/<?= $site ?>">
                        <img width="160" height="42" itemprop="logo" alt="<?= translate('Police') ?> logo" src="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.jpg" />
                        <div><?= escape($zone->title); ?></div>
                    </a>
                </div>
            </div>
            <div class="span9">
                <span class="slogan">
                    <?= JText::sprintf('Call for urgent police assistance', '101', '101') ?>.
                    <?= JText::sprintf('No emergency, just police', escape(str_replace(' ', '', $zone->phone_emergency)), escape($zone->phone_emergency)) ?>.
                </span>
                <div class="navbar">
                    <div class="navbar__handlebar">
                        <div class="navbar__handle">&equiv;</div>
                        <a class="navbar__logo" href="/<?= $site ?>">
                            <img width="27" height="27" src="assets://application/images/logo-flame.jpg" alt="<?= translate('Police') ?> logo" />
                            <?= escape($zone->title); ?>
                        </a>
                    </div>
                    <ktml:modules position="navigation">
                        <ktml:modules:content>
                    </ktml:modules>
                </div>
            </div>
        </div>
    </div>

    <div class="container-banner">
        <div class="row-fluid">
            <div class="span12 alpha">
                <img width="890" height="110" src="assets://application/images/banners/<?= $site ?>.jpg" alt="<?= translate('Police') ?> <?= escape($zone->title); ?> banner" />
            </div>
        </div>
    </div>
    <ktml:modules position="breadcrumbs">
        <div class="container-breadcrumb">
            <div class="row-fluid">
                <div class="span12 alpha">
                    <ktml:modules:content>
                </div>
            </div>
        </div>
    </ktml:modules>

    <div class="container-content <?= $extension ?>">
        <div class="row-fluid">
            <ktml:modules position="left">
                <aside class="span3 alpha sidebar">
                    <ktml:modules:content>
                </aside>
            </ktml:modules>

            <div class="span<?= $extension == 'police' ? '12 alpha' : '9' ?> component">
                <ktml:content>
            </div>
        </div>
    </div>

    <div class="container-footer">
        <div class="row-fluid">
            <div class="span8 alpha">
                <h3><?= translate('Latest news') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <div class="span4">
                <h3><?= translate('Your district officer') ?></h3>
                <?= import('default_district.html') ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container-copyright">
        <div class="row-fluid">
            <div class="span6 alpha">
                <? if($zone->twitter) : ?>
                    <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a> |
                <? endif ?>
                <? if($zone->facebook) : ?>
                    <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a> |
                <? endif ?>
                <a href="/<?= $site ?>/downloads">Downloads</a>
            </div>
            <div class="span6 copyright">
                © 2013 <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
                <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
                <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
                <a href="http://www.belgium.be">Belgium.be</a>
            </div>
        </div>
    </div>
</div>