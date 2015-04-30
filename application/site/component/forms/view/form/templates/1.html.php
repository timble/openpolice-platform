<form action="?view=entry" method="post" class="-koowa-form">
    <input type="hidden" name="forms_form_id" value="<?= $form->id ?>" />

    <?= helper('string.element', array('label' => 'Name')); ?>
    <?= helper('string.element', array('label' => 'Email', 'attribs' => array('type' => 'email'))); ?>
    <?= helper('string.element', array('label' => 'Address')); ?>
    <?= helper('string.element', array('label' => 'Postcode')); ?>
    <?= helper('string.element', array('label' => 'City')); ?>
    <?= helper('string.element', array('label' => 'Country')); ?>
    <?= helper('string.element', array('label' => 'Phone')); ?>
    <?= helper('string.element', array('element' => 'textarea', 'label' => 'Message')); ?>
    <?= helper('string.element', array('label' => 'Identity protection', 'attribs' => array('type' => 'checkbox'), 'options' => array('Option 1', 'Option 2'))); ?>
    <?= helper('string.element', array('label' => 'Identity protection radio', 'attribs' => array('type' => 'radio'), 'options' => array('Option 3', 'Option 4'))); ?>

    <div class="form-actions">
        <button class="button button--primary" type="submit"><?= translate('Send'); ?></button>
    </div>
</form>