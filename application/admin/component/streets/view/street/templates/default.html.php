<?
/**
 * Belgian Police Web Platform - Streets Component
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
		<div class="title">
		    <input disabled class="required" type="text" name="title" maxlength="255" value="<?= $street->title ?>" placeholder="<?= translate('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset>
                <legend><?= translate( 'Information' ); ?></legend>
                <div>
                    <label for="streets_street_id">
                        <?= translate( 'CRAB' ); ?>
                    </label>
                    <div>
                        <input disabled class="required" type="text" name="streets_street_id" value="<?= $street->id ?>" />
                    </div>
                </div>
                <div>
                    <label for="islp">
                        <?= translate( 'ISLP' ); ?>
                    </label>
                    <div>
                        <input type="text" name="islp" class="required" value="<?= $street->islp ?>" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?= translate( 'Districts' ); ?></legend>
                <table class="table table--striped">
                    <thead>
                        <tr>
                            <th><?= translate('District') ?></th>
                            <th><?= translate('Start') ?></th>
                            <th><?= translate('End') ?></th>
                            <th><?= translate('Parity') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach($districts AS $district) : ?>
                        <tr>
                            <td><?= $district->district ?></td>
                            <td><?= $district->range_start ?></td>
                            <td><?= $district->range_end ?></td>
                            <td><?= $district->range_parity ?></td>
                        </tr>
                        <? endforeach ?>
                    </tbody>
                </table>
            </fieldset>
            <fieldset>
                <legend><?= translate( 'Neighborhood information network' ); ?></legend>
                <table class="table table--striped">
                    <thead>
                    <tr>
                        <th><?= translate('Neighborhood') ?></th>
                        <th><?= translate('Start') ?></th>
                        <th><?= translate('End') ?></th>
                        <th><?= translate('Parity') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach($bins AS $bin) : ?>
                        <tr>
                            <td><?= $bin->district ?></td>
                            <td><?= $bin->range_start ?></td>
                            <td><?= $bin->range_end ?></td>
                            <td><?= $bin->range_parity ?></td>
                        </tr>
                    <? endforeach ?>
                    </tbody>
                </table>
            </fieldset>
		</div>
	</div>
</form>