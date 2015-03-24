<? if(!$article->traffic_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=traffic_category_id] label[for=traffic_category_id19] input:radio').prop('checked', true);
        }
    );
</script>
<? endif ?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Details') ?></legend>
    <div>
        <label for="date">
            <?= translate('Start on') ?>
        </label>
        <div>
            <input type="text" name="start_on" id="start_on" class="required" value="<?= helper('date.format', array('date'=> $article->start_on, 'format' => 'd-m-Y')) ?>" />
        </div>
        <script date-inline>
            $jQuery(function(){
                $jQuery('#start_on').datetimepicker({
                    format:'d-m-Y',
                    timepicker:false,
                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                    dayOfWeekStart: '1'
                });
            });
        </script>
    </div>
    <div>
        <label for="date">
            <?= translate('End on') ?>
        </label>
        <div>
            <input type="text" name="end_on" id="end_on" value="<?= $article->end_on ? helper('date.format', array('date'=> $article->end_on, 'format' => 'd-m-Y')) : '' ?>" />
            <script date-inline>
                $jQuery(function(){
                    $jQuery('#end_on').datetimepicker({
                        format:'d-m-Y',
                        onShow:function( ct ){
                            this.setOptions({
                                minDate:$jQuery('#start_on').val()?$jQuery('#start_on').val():false,
                                formatDate: 'd-m-Y',
                                lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                                dayOfWeekStart: '1'
                            })
                        },
                        timepicker:false
                    });
                });
            </script>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <?= helper('com:questions.radiolist.categories', array('row' => $article, 'package' => 'traffic', 'name' => 'traffic_category_id')) ?>
</fieldset>

<fieldset>
    <legend><?= translate('Streets') ?></legend>
    <?= helper('com:streets.listbox.streets', array('selected' => isset($streets) ? $streets->streets_street_identifier : '', 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-streets', 'style' => 'width:100%;'))); ?>
    <script data-inline> $jQuery(".select-streets").select2(); </script>
</fieldset>

<fieldset id="results">
    <legend><?= translate('Results') ?></legend>
    <div>
        <label for="controlled"><?= translate('Controlled') ?></label>
        <div>
            <input type="number" name="controlled" value="<?= $article->controlled ?>" <?= $article->id && $article->traffic_category_id != '19' ? 'disabled' : '' ?> />
        </div>
    </div>
    <div>
        <label for="in_violation"><?= translate('In violation') ?></label>
        <div>
            <input type="number" name="in_violation" value="<?= $article->in_violation ?>" <?= $article->id && $article->traffic_category_id != '19' ? 'disabled' : '' ?> />
        </div>
    </div>
</fieldset>

<script data-inline>
    $jQuery("input[name=traffic_category_id]").click(function()
    {
        if($jQuery('#traffic_category_id19').is(':checked'))
        {
            $jQuery( "#results input").prop("disabled", false);
        } else {
            $jQuery("#results input").prop("disabled", true);
        }
    });
</script>

<? if($article->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$article->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $article->getAttachments())) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>
