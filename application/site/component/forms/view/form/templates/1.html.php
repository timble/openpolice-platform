<form action="?view=entry" method="post" class="-koowa-form">
    <input type="hidden" name="forms_form_id" value="<?= $form->id ?>" />

    <?= helper('string.element', array('label' => 'Name')); ?>
    <?= helper('string.element', array('label' => 'Email', 'attribs' => array('type' => 'email'))); ?>
    <?= helper('string.element', array('label' => 'Street')); ?>
    <?= helper('string.element', array('label' => 'Postcode')); ?>
    <?= helper('string.element', array('label' => 'Town')); ?>
    <?= helper('string.element', array('label' => 'Country')); ?>
    <?= helper('string.element', array('label' => 'Phone')); ?>
    <?= helper('string.element', array('element' => 'textarea', 'label' => 'Message', 'attribs' => array('rows' => '5'))); ?>
    <?= helper('string.element', array('label' => 'Identity protection', 'attribs' => array('type' => 'checkbox'), 'options' => array('I require the protection of my identity data'))); ?>

    <div class="form__actions">
        <button class="button button--primary" type="submit"><?= translate('Send'); ?></button>
    </div>
</form>