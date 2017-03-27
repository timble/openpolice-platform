<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
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
				<legend><?= translate( 'Log' ); ?>:</legend>
                    <table class="table">
                        <thead>
                            <th></th>
                            <th>Before</th>
                            <th>After</th>
                        </thead>
                        <tbody>
                        <? foreach($log->fields['new'] as $key => $value) : ?>
                            <tr>
                                <td><strong><?= ucfirst(escape($key)) ?></strong></td>
                                <td><?= isset($log->fields['old'][$key]) ? escape($log->fields['old'][$key]) : '' ?></td>
                                <td><?= $value ?></td>
                            </tr>
                        <? endforeach ?>
                        </tbody>
                    </table>
			</fieldset>
		</div>
	</div>
</form>