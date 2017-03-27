<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?= helper('behavior.validator') ?>

<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($contact->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
</ktml:module>
<? endif ?>


<form action="" method="post" id="contact-form" class="-koowa-form">
    <input type="hidden" name="id" value="<?= $contact->id; ?>" />
    <input type="hidden" name="published" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $contact->title ?>" placeholder="<?= translate('Name') ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug'); ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= $contact->slug ?>" />
            </div>
        </div>

        <div class="scrollable">
            <fieldset>
                <legend><?= translate('Information'); ?></legend>
                <div>
                    <label for="name"><?= translate( 'Name' ); ?></label>
                    <div>
                        <input type="text" name="name" maxlength="255" value="<?= $contact->name; ?>" />
                    </div>
                </div>
                <div>
                    <label for="email_to"><?= translate( 'E-mail' ); ?></label>
                    <div>
                        <input type="text" name="email_to" maxlength="255" class="validate-email" value="<?= $contact->email_to; ?>" />
                    </div>
                </div>
                <div>
                    <label for="streets_street_id">
                        <?= translate( 'Street' ); ?>
                    </label>
                    <div>
                        <?= import('com:streets.view.streets.autocomplete.html', array('selected' => isset($street) ? $street->id : '', 'identifier' => isset($street) ? $street->streets_street_identifier : '')); ?>
                    </div>
                </div>
                <div>
                    <label for="number"><?= translate( 'Number' ); ?></label>
                    <div>
                        <input type="text" name="number" maxlength="255" value="<?= $contact->number;?>" />
                    </div>
                </div>
                <div>
                    <label for="postcode"><?= translate( 'Postal Code/ZIP' ); ?></label>
                    <div>
                        <input type="text" name="postcode" maxlength="100" value="<?= $contact->postcode; ?>" />
                    </div>
                </div>
                <div>
                    <label for="telephone"><?= translate( 'Telephone' ); ?></label>
                    <div>
                        <input type="text" name="telephone" maxlength="255" value="<?= $contact->telephone; ?>" />
                    </div>
                </div>
                <div>
                    <label for="mobile"><?= translate( 'Mobile' ); ?></label>
                    <div>
                        <input type="text" name="mobile" maxlength="255" value="<?= $contact->mobile; ?>" />
                    </div>
                </div>
                <div>
                    <label for="fax"><?= translate( 'Fax' ); ?></label>
                    <div>
                        <input type="text" name="fax" maxlength="255" value="<?= $contact->fax; ?>" />
                    </div>
                </div>
                <div>
                    <label for="url"><?= translate( 'URL' ); ?></label>
                    <div>
                        <input type="text" name="url" maxlength="255" class="validate-url" value="<?= $contact->url; ?>" />
                    </div>
                </div>
            </fieldset>
        </div>
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'misc', 'text' => $contact->misc, 'toolbar' => 'basic')) ?>
    </div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>