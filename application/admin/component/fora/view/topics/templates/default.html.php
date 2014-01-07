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

<div id="com_fora" class="scrollable">
    <div id="fora-topics-default">
        <div class="fora-search">
            <form action="" method="get" name="search">
                <input type="hidden" name="forum" value="<?=$state->forum;?>"/>
                <input name="search" type="text" placeholder="<?= translate('Search the forums ..') ?>" value="<?= $state->search ? escape($state->search) : null ?>" />
                <input class="btn primary" type="submit" value="Search" disabled="disabled" />
            </form>
        </div>
        <div class="fora-breadcrumbs">
            <?= import('com:fora.module.breadcrumbs.default.html', array('list' => $pathways)) ?>
        </div>
        <div class="well well-small">
            <div class="well__frame">
                <h1 class="well__heading well__heading--left"><?= escape($forum->title) ?></h1>
                <div class="well__toolbar">
                    <a href="<?=route('view=topic&layout=form&forum='.$forum->id)?>" class="btn btn-small"><?=translate('new');?></a>
                    <button type="button" class="btn btn-small subscribe <?= $subscription ? 'btn-subscribed' : 'btn-unsubscribed' ?>" title="Click to manage your subscription"
                            data-row="<?=$forum->id;?>"
                            data-user="<?= object('user')->getId() ?>"
                            data-site="<?=object('application')->getSite();?>"
                            data-action="<?= $subscription ? 'delete' : 'post' ?>"
                            data-type="forum">
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
            url: '<?= html_entity_decode(route('view=subscription'))?>',
            data: {
                _token: '<?= object('user')->getSession()->getToken() ?>'
            }
        });
    });
</script>