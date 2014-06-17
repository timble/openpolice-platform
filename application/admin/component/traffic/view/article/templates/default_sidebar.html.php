<? if(!$article->categories_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=categories_category_id] label:first-of-type input:radio').prop('checked', true);
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
                    lang: '<?= helper('com:police.string.language') ?>',
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
            <input type="text" name="end_on" id="end_on" class="required" value="<?= helper('date.format', array('date'=> $article->end_on, 'format' => 'd-m-Y')) ?>" />
            <script date-inline>
                $jQuery(function(){
                    $jQuery('#end_on').datetimepicker({
                        format:'d-m-Y',
                        onShow:function( ct ){
                            this.setOptions({
                                minDate:$jQuery('#start_on').val()?$jQuery('#start_on').val():false,
                                formatDate: 'd-m-Y',
                                lang: '<?= helper('com:police.string.language') ?>',
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
    <?= helper('com:categories.radiolist.categories', array('row' => $article, 'uncategorised' => false)) ?>
</fieldset>

<? if($article->isStreetable()) : ?>
<fieldset>
    <legend><?= translate('Streets') ?></legend>
    <?= helper('com:streets.listbox.streets', array('selected' => $article->getStreets()->streets_street_id, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-streets', 'style' => 'width:100%;'))); ?>
    <script data-inline> $jQuery(".select-streets").select2(); </script>
</fieldset>
<? endif ?>