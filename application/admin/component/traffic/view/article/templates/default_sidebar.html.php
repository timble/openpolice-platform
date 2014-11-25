<? if(!$article->traffic_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=traffic_category_id] label:first-of-type input:radio').prop('checked', true);
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

<? if($article->isStreetable()) : ?>
<fieldset>
    <legend><?= translate('Streets') ?></legend>
    <?= helper('com:streets.listbox.streets', array('selected' => $article->getStreets()->streets_street_id, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-streets', 'style' => 'width:100%;'))); ?>
    <script data-inline> $jQuery(".select-streets").select2(); </script>
</fieldset>
<? endif ?>

<fieldset>
    <legend><?= translate('Results') ?></legend>
    <div>
        <label for="controlled"><?= translate('Controlled') ?></label>
        <div>
            <input type="number" name="controlled" value="<?= $article->controlled ?>" />
        </div>
    </div>
    <div>
        <label for="in_violation"><?= translate('In violation') ?></label>
        <div>
            <input type="number" name="in_violation" value="<?= $article->in_violation ?>" />
        </div>
    </div>
</fieldset>