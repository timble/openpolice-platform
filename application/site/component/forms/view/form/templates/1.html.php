<form action="?view=entry&id=<?= $entry ? $entry->id : '' ?>" method="post" class="-koowa-form">
    <input type="hidden" name="forms_form_id" value="<?= $form->id ?>" />

    <?= helper('string.element', array('label' => 'Name', 'entry' => $entry)); ?>
    <?= helper('string.element', array('label' => 'Email', 'entry' => $entry, 'attribs' => array('type' => 'email', 'required' => 'required'))); ?>
    <?= helper('string.element', array('label' => 'Street', 'entry' => $entry, 'attribs' => array('required' => 'required'))); ?>
    <?= helper('string.element', array('label' => 'Postcode', 'entry' => $entry)); ?>
    <?= helper('string.element', array('label' => 'Town', 'entry' => $entry)); ?>
    <?= helper('string.element', array('label' => 'Country', 'entry' => $entry)); ?>
    <?= helper('string.element', array('label' => 'Phone', 'entry' => $entry)); ?>
    <?= helper('string.element', array('element' => 'textarea', 'entry' => $entry, 'label' => 'Message', 'attribs' => array('rows' => '5'))); ?>
    <?= helper('string.element', array('label' => 'Identity protection', 'entry' => $entry, 'attribs' => array('type' => 'checkbox'), 'options' => array('I require the protection of my identity data'))); ?>

    <!-- The following field is for robots only, invisible to humans: -->
    <div class="form__group" id="honey-pot">
        <label><?= translate('If you are human leave this blank') ?></label>
        <input name="robotest" type="text" id="robotest" class="robotest" />
    </div>

    <div class="form__actions">
        <button class="button button--primary" type="submit"><?= translate('Send'); ?></button>
    </div>
</form>