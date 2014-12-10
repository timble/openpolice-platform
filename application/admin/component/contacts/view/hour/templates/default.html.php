<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />
<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />
<style src="assets://contacts/css/switch.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="appointment" value="0" />
    <input type="hidden" name="closed" value="0" />
    <input type="hidden" name="opening_time" value="" />
    <input type="hidden" name="closing_time" value="" />

    <div class="main">
		<div class="scrollable">
            <fieldset>
                <legend><?= translate( 'Type' ); ?></legend>
                <div>
                    <label for="exception">
                        <?= translate( 'Exception' ); ?>
                    </label>
                    <div>
                        <div class="switch switch-blue">
                            <input type="radio" class="switch-input" name="exception" value="no" id="no" <?= !$hour->date ? 'checked' : '' ?>>
                            <label for="no" class="switch-label switch-label-off">No</label>
                            <input type="radio" class="switch-input" name="exception" value="yes" id="yes" <?= $hour->date ? 'checked' : '' ?>>
                            <label for="yes" class="switch-label switch-label-on">Yes</label>
                            <span class="switch-selection"></span>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="name">
                        <?= translate( 'Day' ); ?>
                    </label>
                    <div class="controls">
                        <div id="days" <?= $hour->date ? 'style="display: none"' :'' ?>>
                            <?= helper('listbox.days', array('name' => 'day_of_week', 'selected' => $hour->day_of_week)) ?>
                        </div>
                        <div id="day" <?= !$hour->date ? 'style="display: none"' :'' ?>>
                            <input id="date" type="text" name="date" value="<?= $hour->date ? helper('date.format', array('date'=> $hour->date, 'format' => 'd-m-Y')) : '' ?>" />
                            <script data-inline>
                                $jQuery("#date").datetimepicker({
                                    timepicker:false,
                                    inline: true,
                                    format:'d-m-Y',
                                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                                    dayOfWeekStart: '1'
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
				<legend><?= translate( 'Information' ); ?></legend>
                <div>
				    <label for="name">
				    	<?= translate( 'Contact' ); ?>
				    </label>
				    <div>
                        <?= helper('listbox.contacts', array('name' => 'contacts_contact_id', 'selected' => $hour->contacts_contact_id ? $hour->contacts_contact_id : $state->contact, 'attribs' => array('id' => 'select-contact', 'class' => 'required', 'style' => 'width:100%'))) ?>
                        <script data-inline> $jQuery("#select-contact").select2(); </script>
                    </div>
				</div>
                <div>
                    <label for="closed"><?= translate( 'Closed' ); ?></label>
                    <div>
                        <input type="checkbox" name="closed" value="1" <?= $closed  ? 'checked="checked"' : '' ?> />
                    </div>
                </div>
                <div>
                    <label for="appointment"><?= translate( 'Appointment only' ); ?></label>
                    <div>
                        <input type="checkbox" name="appointment" value="1" <?= $hour->appointment ? 'checked="checked"' : '' ?> <?= $closed ? 'disabled' : '' ?> />
                    </div>
                </div>
				<div>
				    <label for="opening_time">
				    	<?= translate( 'Opening Time' ); ?>
				    </label>
				    <div>
                        <input class="required" name="opening_time" type="text" value="<?= $hour->opening_time; ?>" id="opening_time" <?= $hour->appointment || $closed ? 'disabled' : '' ?> />
                        <script data-inline> $jQuery("#opening_time").datetimepicker({datepicker:false, format:'H:i'}); </script>
				    </div>
				</div>
				<div>
				    <label for="closing_time">
				    	<?= translate( 'Closing Time' ); ?>
				    </label>
				    <div>
				        <input class="required" name="closing_time" type="text" value="<?= $hour->closing_time; ?>" id="closing_time" <?= $hour->appointment || $closed ? 'disabled' : '' ?> />
                        <script data-inline> $jQuery("#closing_time").datetimepicker({datepicker:false, format:'H:i'}); </script>
				    </div>
				</div>
                <div>
                    <label for="note"><?= translate( 'Note' ); ?></label>
                    <div>
                        <input type="text" name="note" maxlength="50" value="<?= $hour->note; ?>" />
                    </div>
                </div>
			</fieldset>
		</div>
	</div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>

<script data-inline>
    $jQuery('input:radio[name="exception"]').change(function(){
        $jQuery("#day").toggle();
        $jQuery("#days").toggle();
    });
    $jQuery("input[name=appointment]").click(function(){
        $jQuery("input[name=opening_time]").attr('disabled', this.checked)
        $jQuery("input[name=closing_time]").attr('disabled', this.checked)
    });
    $jQuery("input[name=closed]").click(function(){
        $jQuery("input[name=opening_time]").attr('disabled', this.checked)
        $jQuery("input[name=closing_time]").attr('disabled', this.checked)
        $jQuery("input[name=appointment]").attr('disabled', this.checked)
    });
</script>