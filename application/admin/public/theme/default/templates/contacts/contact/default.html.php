<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" id="contact-form" class="-koowa-form">
    <input type="hidden" name="id" value="<?= $contact->id; ?>" />
    <input type="hidden" name="access" value="0" />
    <input type="hidden" name="published" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="name" maxlength="255" value="<?= $contact->name ?>" placeholder="<?= translate('Name') ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug'); ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= $contact->slug ?>" />
            </div>
        </div>

        <div class="scrollable">
            <fieldset>
                <legend><?= translate('Information'); ?></legend>
                <div>
                    <label for="email_to"><?= translate( 'E-mail' ); ?></label>
                    <div>
                        <input type="text" name="email_to" maxlength="255" class="validate-email" value="<?= $contact->email_to; ?>" />
                    </div>
                </div>
                <div>
                    <label for="address"><?= translate( 'Street Address' ); ?></label>
                    <div>
                        <input type="text" name="address" maxlength="255" value="<?= $contact->address;?>" />
                    </div>
                </div>
                <div>
                    <label for="postcode"><?= translate( 'Postal Code/ZIP' ); ?></label>
                    <div>
                        <input type="text" name="postcode" maxlength="100" value="<?= $contact->postcode; ?>" />
                    </div>
                </div>
                <div>
                    <label for="suburb"><?= translate( 'Town/Suburb' ); ?></label>
                    <div>
                        <input type="text" name="suburb" maxlength="100" value="<?= $contact->suburb;?>" />
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
            </fieldset>
        </div>
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'misc', 'text' => $contact->misc, 'toolbar' => 'basic')) ?>
    </div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>