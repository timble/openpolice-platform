<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<script src="assets://js/koowa.js" />
<script src="assets://support/js/comment.js" />
<script src="assets://files/js/uri.js" />

<style src="assets://support/css/default.css" />

<script>
    window.addEvent('domready', function() {
        new Comment({
            container: 'comment',
            action: '<?= route('&view=comment&row='.$zone->id.'&table=support_tickets') ?>',
            token: '<?= $this->getObject('user')->getSession()->getToken() ?>'
        });
    });
</script>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="support__ticket" class="scrollable">
    <div class="header">
        <h1>
            <?= escape($zone->title) ?>
        </h1>
        <?= $zone->created_by_name ?> - <?= helper('date.format', array('date'=> $zone->created_on, 'format' => 'd F Y H:m')) ?>
        <span class="label label-<?= $zone->status ?>"><?= translate($zone->status) ?></span>
    </div>

    <form id="comment" class="group" action="<?= route('&view=comment&row='.$zone->id.'&table=support_tickets') ?>" method="post">
        <input type="hidden" name="row" value="<?= $zone->id ?>" />
        <input type="hidden" name="table" value="support_tickets" />
        <input type="hidden" name="status" value="" />
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => '', 'toolbar' => 'basic')) ?>
        <br />
        <a class="btn" href="#" data-action="submit" data-status="open">
            <?= translate('Submit') ?>
        </a>
        <? if($user->getRole() == '25') : ?>
        <a class="btn btn-warning" href="#" data-action="submit" data-status="pending">
            <?= translate('Submit as Pending') ?>
        </a>
        <? endif ?>
        <a class="btn btn-success" href="#" data-action="submit" data-status="solved">
            <?= translate('Submit as Solved') ?>
        </a>
    </form>

    <div class="comments">
        <? foreach($zone->getComments() as $comment) : ?>
        <div class="comment comment_<?= $comment->id ?>">
            <strong><?= $comment->created_by == $user->getId() ? translate('You') : $comment->created_by_name ?></strong>
            <span class="muted">
                <?= helper('date.format', array('date'=> $comment->created_on, 'format' => 'd F Y H:i')) ?>
            </span>
            <div class="comment__text">
                <?= $comment->text ?>
            </div>
        </div>
        <? endforeach; ?>

        <div class="comment">
            <strong><?= $zone->created_by == $user->getId() ? translate('You') : $zone->created_by_name ?></strong>
            <span class="muted">
                <?= helper('date.format', array('date'=> $zone->created_on, 'format' => 'd F Y H:i')) ?>
            </span>
            <?= $zone->text ?>
        </div>
    </div>
</div>
