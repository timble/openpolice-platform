<form action="?view=entry&id=<?= $entry ? $entry->id : '' ?>" method="post" class="-koowa-form">
    <input type="hidden" name="forms_form_id" value="<?= $form->id ?>" />

    <fieldset class="form__fieldset">
        <legend><?= translate('Evenement') ?></legend>
        <?= helper('string.element', array('label' => 'Datum van het evenement', 'entry' => $entry, 'attribs' => array('type' => 'date'))); ?>
        <?= helper('string.element', array('label' => 'Uur van aanvang van het evenement', 'entry' => $entry, 'attribs' => array('type' => 'time'))); ?>
        <?= helper('string.element', array('label' => 'Naam van het evenement', 'entry' => $entry, 'hint' => "(titel op flyers, website, affiche, reclame, ...)")); ?>
        <?= helper('string.element', array('label' => 'Soort evenement', 'entry' => $entry, 'hint' => '(fuif, optreden, cantus, ...)')); ?>
        <?= helper('string.element', array('label' => 'Verwacht aantal deelnemers', 'entry' => $entry, 'attribs' => array('type' => 'number'))); ?>
    </fieldset>

    <fieldset class="form__fieldset">
        <legend><?= translate('Locatie') ?></legend>
        <?= helper('string.element', array('label' => 'Naam locatie / horecazaak', 'entry' => $entry)); ?>
        <?= helper('string.element', array('label' => 'Straat van de locatie / horecazaak', 'entry' => $entry)); ?>
        <?= helper('string.element', array('label' => 'Huisnummer van de locatie / horecazaak', 'entry' => $entry)); ?>
    </fieldset>

    <fieldset class="form__fieldset">
        <legend><?= translate('Organisatie of verantwoordelijke') ?></legend>
        <?= helper('string.element', array('label' => 'Organisatie', 'entry' => $entry, 'attribs' => array('type' => 'checkbox'), 'options' => array('Privé persoon', 'Andere'))); ?>
        <?= helper('string.element', array('label' => 'Naam van de verantwoordelijke', 'entry' => $entry)); ?>
        <?= helper('string.element', array('label' => 'Geboortedatum verantwoordelijke', 'entry' => $entry, 'attribs' => array('type' => 'date'))); ?>
        <?= helper('string.element', array('label' => 'Straat van de verantwoordelijke', 'entry' => $entry)); ?>
        <?= helper('string.element', array('label' => 'Huisnummer van de verantwoordelijke', 'entry' => $entry)); ?>
        <?= helper('string.element', array('label' => 'E-mail verantwoordelijke of organisatie', 'entry' => $entry, 'attribs' => array('type' => 'email'))); ?>
        <?= helper('string.element', array('label' => 'Telefoonnummer (verantwoordelijke)', 'entry' => $entry)); ?>
    </fieldset>

    <!-- The following field is for robots only, invisible to humans: -->
    <div class="form__group form__honey-pot">
        <label><?= translate('If you are human leave this blank') ?></label>
        <input name="robotest" type="text" id="robotest" class="robotest" />
    </div>

    <div class="form__actions">
        <button class="button button--primary" type="submit"><?= translate('Send'); ?></button>
        <a href="#" data-confirm="<?= translate('Are you sure you wish to cancel this visit request? This will delete all the information you have entered') ?>"><?= translate('Cancel and delete all details') ?></a>
    </div>
</form>