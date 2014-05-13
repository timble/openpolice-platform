<?= overlay(array('url' => route('option=com_activities&view=activities&layout=list'))); ?>

<div class="sidebar">
    <h3><?= translate('Announcements'); ?></h3>
    <?= object('com:support.controller.announcement')->layout('table')->limit(10)->render(); ?>
</div>