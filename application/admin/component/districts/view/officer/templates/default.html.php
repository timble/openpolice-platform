<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="scrollable">
				<fieldset>
					<legend><?= translate( 'Information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= translate( 'Firstname' ); ?>
					    </label>
					    <div>
					        <input type="text" name="firstname" maxlength="250" class="required" value="<?= $officer->firstname; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Lastname' ); ?>
					    </label>
					    <div>
					        <input type="text" name="lastname" maxlength="250" class="required" value="<?= $officer->lastname; ?>" />
					    </div>
					</div>
                    <div>
                        <label for="">
                            <?= translate( 'Number' ); ?>
                        </label>
                        <div>
                            <input type="text" name="id" maxlength="250" class="required validate-integer" value="<?= $officer->id; ?>" />
                        </div>
                    </div>
					<div>
					    <label for="">
					    	<?= translate( 'Position' ); ?>
					    </label>
					    <div>
					        <input type="text" name="position" maxlength="250" value="<?= $officer->position; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Phone' ); ?>
					    </label>
					    <div>
					        <input type="text" name="phone" maxlength="250" class="validate-digits" value="<?= $officer->phone; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Mobile' ); ?>
					    </label>
					    <div>
					        <input type="text" name="mobile" maxlength="250" class="validate-digits" value="<?= $officer->mobile; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'E-mail' ); ?>
					    </label>
					    <div>
					        <input type="email" name="email" maxlength="250" class="validate-email" value="<?= $officer->email; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?= translate( 'Districts' ); ?></legend>
					<ul>
                        <? if(!count($districts)) : ?>
                        <li><?= translate('No district') ?></li>
                        <? else : ?>
                        <? foreach ($districts as $value) : ?>
						<li><?= escape($value->district); ?></li>
					    <? endforeach; ?>
					<? endif ?>
					</ul>
				</fieldset>
			</div>
        </div>
        <div class="sidebar">
            <? if($officer->isAttachable()) : ?>
                <fieldset>
                    <legend><?= translate('Image') ?></legend>
                    <? if (!$officer->isNew()) : ?>
                        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $officer->getAttachments(), 'attachments_attachment_id' => $officer->attachments_attachment_id)) ?>
                    <? endif ?>
                    <?= import('com:attachments.view.attachments.upload.html') ?>
                </fieldset>
            <? endif ?>
		</div>
	</div>
</form>
