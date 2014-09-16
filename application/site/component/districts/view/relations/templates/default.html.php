<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<style src="assets://application/components/select2/select2.css" />

<script src="assets://application/components/jquery/dist/jquery.min.js" />
<script src="assets://application/components/select2/select2.js" />
<script src="assets://application/js/ie7.js" condition="if lte IE 7" />

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

<script data-inline>
    $(document).ready(function() {
        function format(item) { return item.title; };
        $("#autocomplete__streets").select2({
            placeholder: "<?= translate('Search your street') ?> ...",
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "?view=streets&format=json&has_district=1",
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
                    $.ajax("?view=street&format=json&id="+id, {
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
        <div class="form__group<?= is_null($state->street) ? ' has-error' : '' ?>">
            <label class="form__label" for="street"><?= @translate('Street') ?><sup>*</sup>:</label>
            <div class="contenedor-select2">
                <input type="text" class="bigdrop form__input" id="autocomplete__streets" placeholder="<?= @translate('Search your street') ?> ..." tabindex="1" name="street" value="<?= $state->street != '0' ? $state->street : '' ?>">
            </div>
        </div>
        <div class="form__group<?= !is_numeric($state->number) || is_null($state->number) ? ' has-error' : '' ?>">
            <label class="form__label" for="number"><?= @translate('Street number') ?><sup>*</sup>:</label>
            <input class="form__input" type="number" min="1" placeholder="<?= @translate('Street number') ?>" tabindex="2" id="number" name="number" value="<?= $state->number != '0' ? $state->number : '' ?>">
            <? if(!is_numeric($state->number) && !is_null($state->number)) : ?>
            <span class="form__feedback"><?= @translate('Only numbers are allowed.') ?></span>
            <? endif ?>
        </div>
        <button type="submit" class="button button--primary" tabindex="3"><?= translate('Search') ?></button>
    </form>
</div>

<? if ($state->street && is_numeric($state->number)) : ?>
    <ul>
        <? foreach ($relations as $relation) : ?>
        <li>
            <a href="<?= helper('route.district', array('row' => $relation)) ?>">
                <?= $relation->street ?> <?= helper('string.street', array('row' => $relation)) ?>
            </a>
        </li>
        <? endforeach; ?>
    </ul>
    <? if(!count($relations)) : ?>
        <h2 role="alert" style="text-align: center;margin: 60px 0"><?= translate('No neighbourhood officer found') ?>.</h2>
        <? $zone = object('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow() ?>
        <? $email = str_replace("@", "&#64;", $zone->email) ?>
        <? $email = str_replace(".", "&#46;", $email) ?>

        <div class="well well--small text-center">
            <?= translate('Contact us at') ?> <a href="mailto:<?= $email ?>"><?= $email ?></a> <?= translate('or') ?> <span class="nowrap"><?= $zone->phone_information ? $zone->phone_information : $zone->phone_emergency ?></span>.
        </div>
    <? endif ?>

    <?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>