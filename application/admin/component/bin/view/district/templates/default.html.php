<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?= helper('behavior.validator'); ?>
<?= helper('behavior.modal'); ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input id="title" class="required" type="text" name="title" size="32" maxlength="250" value="<?= $district->title; ?>" placeholder="<?= translate('Title') ?>" />
		</div>

		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'District' ); ?></legend>
                <div>
                    <label for="">
                        <?= translate( 'Twitter' ); ?>
                    </label>
                    <div>
                        <input type="text" name="twitter" maxlength="250" value="<?= $district->twitter; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Facebook' ); ?>
                    </label>
                    <div>
                        <input type="text" name="facebook" maxlength="250" value="<?= $district->facebook; ?>" />
                    </div>
                </div>
			</fieldset>
            <fieldset>
                <legend><?= translate( 'Coordinator' ); ?></legend>
                <div>
                    <label for="">
                        <?= translate( 'Firstname' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_firstname" maxlength="250" class="required" value="<?= $district->coordinator_firstname; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Lastname' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_lastname" maxlength="250" class="required" value="<?= $district->coordinator_lastname; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Address' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_address" maxlength="250" value="<?= $district->coordinator_address; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Postcode' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_postcode" maxlength="250" value="<?= $district->coordinator_postcode; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Suburb' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_suburb" maxlength="250" value="<?= $district->coordinator_suburb; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Phone' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_phone" maxlength="250" class="validate-digits" value="<?= $district->coordinator_phone; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'Mobile' ); ?>
                    </label>
                    <div>
                        <input type="text" name="coordinator_mobile" maxlength="250" class="validate-digits" value="<?= $district->coordinator_mobile; ?>" />
                    </div>
                </div>
                <div>
                    <label for="">
                        <?= translate( 'E-mail' ); ?>
                    </label>
                    <div>
                        <input type="email" name="coordinator_email" maxlength="250" class="validate-email" value="<?= $district->coordinator_email; ?>" />
                    </div>
                </div>

            </fieldset>
		</div>
	</div>
</form>
