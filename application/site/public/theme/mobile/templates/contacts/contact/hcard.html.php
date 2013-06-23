<?
/**
 * @package     Nooku_Server
 * @subpackage  Contacts
 * @copyright	Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.nooku.org
 */
?>

<?= @helper('behavior.mootools') ?>
<?= @helper('behavior.modal', array('selector' => 'a.modalbox')) ?>

<address class="vcard">
    <div class="page-header">
        <h1 class="fn url" href="<?= @route(); ?>"><?= $contact->name?></h1>
    </div>
    <?if ($contact->con_position) : ?>
        <h2 class="title"><?= $contact->con_position?></h2>
    <? endif;?>
    <div class="row">
        <div class="span6">
            <div class="adr">
                <? if ($contact->address) : ?>
                    <div class="street-address"><?= $contact->address?></div>
                <? endif; ?>
                <?if ($contact->postcode) : ?>
                    <span class="postal-code"><?= $contact->postcode?></span>
                <? endif; ?>
                <? if ( $contact->suburb) : ?>
                    <span class="locality"><?= $contact->suburb?></span>
                <? endif; ?>
                <? if ($contact->country) : ?>
                    <div class="country-name"><?= $contact->country?></div>
                <? endif; ?>
            </div>
            <ul>
                <? if ($contact->telephone) :?>
                    <li class="tel">
                        <span class="type"><?= @text('Phone') ?></span>:
                        <span class="value"><?= $contact->telephone?></span>
                    </li>
                <? endif; ?>
                <? if ($contact->fax) :?>
                    <li class="tel">
                        <span class="type"><?= @text('Fax') ?></span>:
                        <span class="value"><?= $contact->fax?></span>
                    </li>
                <? endif; ?>
                <?if ($contact->mobile) :?>
                    <li class="tel">
                        <span class="type"><?= @text('Mobile') ?></span>:
                        <span class="value"><?= $contact->mobile?></span>
                    </li>
                <? endif; ?>
                <?if ($contact->email_to && $contact->params->get('show_email', false)) :?>
                    <li>
                        <span><?= @text('Email') ?></span>:
                        <a class="email" href="mailto:<?= $contact->email_to?>"><?= $contact->email_to?></a>
                    </li>
                <? endif; ?>
            </ul>
            <?if ($contact->misc) :?>
                <p class="note">
                    <?= $contact->misc ?>
                </p>
            <? endif; ?>
        </div>
        <div class="span3">
            <? if($contact->isAttachable()) : ?>
                <? foreach($contact->getAttachments() as $item) : ?>
                    <? if($item->file->isImage()) : ?>
                        <img style="margin-bottom: 10px" class="photo thumbnail" align="right" src="<?= $item->thumbnail->thumbnail ?>" />
                    <? endif ?>
                <? endforeach ?>
            <? endif ?>
            <? if ($contact->address) : ?>
                <? $map = "http://maps.googleapis.com/maps/api/staticmap?maptype=roadmap
&markers='.$contact->address.','.$contact->suburb.','.$contact->country.'&sensor=false"; ?>
                <a rel="{handler: 'image'}" class="modalbox" href="<?= $map ?>&size=800x600&zoom=15">
                    <img class="thumbnail" src="<?= $map ?>&size=200x200&zoom=13" />
                </a>
            <? endif; ?>
        </div>
    </div>
</address>