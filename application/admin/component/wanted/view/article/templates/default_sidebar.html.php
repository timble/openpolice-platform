<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
    <div>
        <label for="publish_on"><?= translate('Publish on') ?></label>
        <div class="controls">
            <input id="publish_on" type="text" name="publish_on" value="<?= $article->publish_on ? helper('date.format', array('date'=> $article->publish_on, 'format' => 'd-m-Y H:i')) : '' ?>" <?= $article->published ? 'disabled="disabled"' : '' ?> />
            <script data-inline>
                $jQuery("#publish_on").datetimepicker({
                    format:'d-m-Y H:i',
                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                    dayOfWeekStart: '1'
                });
            </script>
        </div>
    </div>
    <div>
        <label for="solved"><?= translate('Solved') ?></label>
        <div>
            <input type="checkbox" name="solved" value="1" <?= $article->solved ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Metadata') ?></legend>
    <div>
        <label for="date"><?= translate('Date') ?></label>
        <div>
            <input type="text" name="date" value="<?= $article->date ? helper('date.format', array('date'=> $article->date, 'format' => 'd-m-Y')) : '' ?>" class="required" />
            <script data-inline>
                $jQuery("[name=date]").datetimepicker({
                    timepicker:false,
                    format:'d-m-Y',
                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                    dayOfWeekStart: '1'
                });
            </script>
        </div>
    </div>
    <div>
        <label for="streets_city_id">
            <?= translate( 'Belgium' ); ?>
        </label>
        <div>
            <?= import('com:streets.view.cities.autocomplete.html', array('selected' => $article->streets_city_id)); ?>
        </div>
    </div>
    <div>
        <label for="params[place]"><?= translate('Foreign country') ?></label>
        <div>
            <input type="text" name="params[place]" value="<?= $article->params['place'] ?>" />
        </div>
    </div>
    <div>
        <label for="case_id]"><?= translate('Case ID') ?></label>
        <div>
            <input type="text" name="case_id" value="<?= $article->case_id ?>" />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <? foreach ($sections as $section) : ?>
        <h3><?= $section->title ?></h3>
        <?= helper('com:questions.radiolist.categories', array('row' => $article, 'package' => 'wanted', 'name' => 'wanted_category_id', 'filter' => array('section' => $section->id, 'sort' => 'ordering'))) ?>
    <? endforeach ?>
</fieldset>

<? if($article->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$article->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $article->getAttachments(), 'attachments_attachment_id' => $article->attachments_attachment_id)) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>

<fieldset>
    <legend><?= translate('Embeds') ?></legend>
    <div>
        <label for="params[youtube]"><?= translate('Youtube') ?></label>
        <div>
            <input type="text" name="params[youtube]" value="<?= $article->params['youtube'] ?>" placeholder="http://youtu.be/hPxxxgI_7LY" />
        </div>
    </div>
</fieldset>

<? if(!$article->wanted_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=wanted_category_id]:first-of-type label:first-of-type input:radio').prop('checked', true);
        }
    );
</script>
<? endif ?>

<script data-inline>
    $jQuery("input[name=published]").click(function()
    {
        $jQuery("input[name=publish_on]").attr('disabled', this.checked)
    });
</script>