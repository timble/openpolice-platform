<title content="replace"><?= $contact->name ?></title>

<? if ($contact->params->get('allow_vcard', false)) : ?>
    <link href="<?= route('format=vcard') ?>" rel="alternate" type="text/x-vcard; version=2.1" title="Vcard - <?= $contact->name; ?>"/>
<? endif; ?>

<?= import('hcard.html') ?>

<?if ($contact->params->get('allow_vcard', false)) :?>
    <p>
        <?= translate( 'Download information as a' );?>
        <a href="<?= route('id='.$contact->id.'&format=vcard') ?>">
            <?= translate( 'VCard' );?>
        </a>
    </p>
<? endif; ?>

<? if ( $contact->params->get('show_email_form', false) && $contact->email_to) : ?>
    <?= object('com:contacts.controller.message')->render(array('contact' => $contact, 'category' => $category)); ?>
<? endif; ?>