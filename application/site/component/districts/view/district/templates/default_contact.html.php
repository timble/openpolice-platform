<? $email_to = str_replace("@", "&#64;", $contact->email_to) ?>
<? $email_to = str_replace(".", "&#46;", $email_to) ?>

<address class="vcard">
    <h2 class="article__header fn url" href="<?= route(); ?>"><?= $contact->title?></h2>
    <?if ($contact->con_position) : ?>
        <h2 class="title"><?= $contact->con_position?></h2>
    <? endif;?>
    <div class="adr">
        <? if ($contact->street || $contact->number) : ?>
            <span itemprop="streetAddress"><?= $contact->street ?> <?= $contact->number?></span><br />
        <? elseif ($contact->address) : ?>
            <span itemprop="streetAddress"><?= $contact->address ?></span><br />
        <? endif; ?>
        <?if ($contact->postcode) : ?>
            <span class="postal-code"><?= $contact->postcode?></span>
        <? endif; ?>
        <? if ($contact->city) : ?>
            <span itemprop="addressLocality"><?= $contact->city?></span>
        <? elseif ($contact->suburb) : ?>
            <span itemprop="addressLocality"><?= $contact->suburb ?></span><br />
        <? endif; ?>
        <? if ($contact->country) : ?>
            <div class="country-name"><?= $contact->country?></div>
        <? endif; ?>
    </div>
    <ul>
        <? if ($contact->telephone) :?>
            <li class="tel">
                <span class="type"><?= translate('Phone') ?></span>:
                <span class="value"><?= $contact->telephone?></span>
            </li>
        <? endif; ?>
        <? if ($contact->fax) :?>
            <li class="tel">
                <span class="type"><?= translate('Fax') ?></span>:
                <span class="value"><?= $contact->fax?></span>
            </li>
        <? endif; ?>
        <?if ($contact->mobile) :?>
            <li class="tel">
                <span class="type"><?= translate('Mobile') ?></span>:
                <span class="value"><?= $contact->mobile?></span>
            </li>
        <? endif; ?>
        <?if ($contact->email_to) :?>
            <li>
                <span><?= translate('Email') ?></span>:
                <a class="email" href="mailto:<?= $email_to?>"><?= $email_to?></a>
            </li>
        <? endif; ?>
    </ul>
    <?= $contact->misc ?>
</address>

<?= object('com:contacts.controller.hour')->contact($contact->id)->render(array('contact' => $contact)); ?>