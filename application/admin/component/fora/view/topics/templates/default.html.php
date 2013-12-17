<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<style src="assets://fora/css/default.css" />
<script src="assets://fora/js/subscribe.js" />
<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="com_fora" class="scrollable">
    <div id="fora-topics-default">
        <div class="well well-small">
            <form action="" method="get" name="search">
                <input type="hidden" name="forum" value="<?=$state->forum;?>"/>
                <input name="search" type="text" placeholder="<?= translate('Search the forums ..') ?>" value="<?= $state->search ? escape($state->search) : null ?>" autofocus="autofocus" />
                <input class="btn primary" type="submit" value="Search" disabled="disabled" />
            </form>
        </div>
        <div class="well well-small">
            <ul class="breadcrumb">
                <? foreach($pathways as $item) : ?>
                    <? // If not the last item in the breadcrumbs add the separator ?>
                    <? if($item !== end($pathways)) : ?>
                        <? if(!empty($item->link)) : ?>
                            <li><a href="<?= $item->link ?>" class="pathway"><?= escape($item->name) ?></a></li>
                        <? else : ?>
                            <li><?= escape($item->name) ?></li>
                        <? endif ?>
                        <span class="divider">&rsaquo;</span>
                    <? else : ?>
                        <li><?= escape($item->name) ?></li>
                    <? endif ?>
                <? endforeach ?>
            </ul>
        </div>
        <div class="well well-small">
            <div class="well__frame">
                <h1 class="well__heading well__heading--left"><?= escape($forum->title) ?></h1>
                <div class="well__toolbar">
                    <button type="button" class="btn btn-small subscribe <?= $subscription ? 'btn-subscribed' : 'btn-unsubscribed' ?>" title="Click to manage your subscription">
                        <i class="icon-star"></i>
                    </button>
                </div>
            </div>

            <div class="well__content">

                <div class="media__items">
                    <? foreach($topics as $topic) : ?>
                        <?= import('default_items.html', array('topic' => $topic)); ?>
                    <? endforeach ?>
                </div>

                <? if(!$total) : ?>
                    <? if(!$state->search) : ?>
                        <p><?= translate('This forum does not contain any topics yet') ?>.</p>
                    <?else: ?>
                        <p><?= translate('Your search') ?> - <strong><?= $state->search ?></strong> - <?= translate('did not match anything inside our forums') ?>.</p>

                        <p><?= translate('Suggestions') ?>:</p>
                        <ul>
                            <li><?= translate('Make sure all words are spelled correctly') ?>;</li>
                            <li><?= translate('Try different keywords') ?>;</li>
                            <li><?= translate('Try more generic keywords') ?>.</li>
                        </ul>
                    <? endif; ?>
                <? endif; ?>

            </div>

        </div>
    </div>
</div>

<script data-inline>
    jQuery( document ).ready(function($) {
        new Fora.Subscribe({
            holder: 'fora-topics-default',
            url: '<?= html_entity_decode(route('view=subscription&type=forum&row='.$forum->id))?>',
            data: {
                action: '<?= $subscription ? 'delete' : 'add' ?>',
                type: 'forum',
                row: '<?= $forum->id ?>',
                users_user_id: '<?= object('user')->getId() ?>',
                _token: '<?= object('user')->getSession()->getToken() ?>',
                site: '<?=object('application')->getSite();?>'
            }
        });
    });
</script>