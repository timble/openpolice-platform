<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if(!$item->found_category_id) : ?>
    <script>
        // Set default value for categories radiolist
        $jQuery(document).ready(
            function(){
                $jQuery('fieldset[name=found_category_id] label:first-of-type input:radio').prop('checked', true);
            }
        );
    </script>
<? endif ?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $item->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Details') ?></legend>
    <div>
        <label for="found_on"><?= translate('Found on') ?></label>
        <div class="controls">
            <input id="found_on" type="text" name="found_on" value="<?= $item->found_on ? helper('date.format', array('date'=> $item->found_on, 'format' => 'd-m-Y')) : '' ?>" />
            <script data-inline>
                $jQuery("#found_on").datetimepicker({
                    format:'d-m-Y',
                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                    dayOfWeekStart: '1',
                    timepicker: false
                });
            </script>
        </div>
    </div>
    <div>
        <label for="streets_street_id">
            <?= translate( 'Street' ); ?>
        </label>
        <div>
            <?= import('com:streets.view.streets.autocomplete.html', array('selected' => !$item->isNew() && isset($street) ? $street->streets_street_identifier : '')); ?>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <?= helper('com:questions.radiolist.categories', array('row' => $item, 'package' => 'found', 'name' => 'found_category_id')) ?>
</fieldset>

<? if($item->isAttachable()) : ?>
    <fieldset>
        <legend><?= translate('Attachments') ?></legend>
        <? if (!$item->isNew()) : ?>
            <?= import('com:attachments.view.attachments.list.html', array('attachments' => $item->getAttachments(), 'attachments_attachment_id' => $item->attachments_attachment_id)) ?>
        <? endif ?>
        <?= import('com:attachments.view.attachments.upload.html') ?>
    </fieldset>
<? endif ?>