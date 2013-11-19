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
<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="com_fora">
    <div id="fora-topics-default">
        <div class="well well-small">
            <form action="" method="get" name="search">
                <input type="hidden" name="forum" value="<?=$state->forum;?>"/>
                <input name="search" type="text" placeholder="<?= translate('Search the forums ..') ?>" value="<?= $state->search ? escape($state->search) : null ?>" autofocus="autofocus" />
                <input class="btn primary" type="submit" value="Search" disabled="disabled" />
            </form>
        </div>

        <div class="well well-small">
            <div class="well__heading--left">
                <h3><?=$forums->title;?></h3>
            </div>
            <div class="well__heading--right">
                <button id="subscription" class="btn-mini <?=$subscription->row? 'btn-unsubscribed':'btn-subscribed';?>">
                    <?=$subscription->row ? translate('Unsubscrib'): translate('Subscribe');?>
                </button>
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
        $('#subscription').click(function(e){
            e.preventDefault();
            var data = {};

            // Need to do this because we don't know what field there is being edited....
            data['type']   ='forum';
            data['row']    = '<?=$state->forum;?>';
            data['user_id'] = '<?=object('user')->getId();?>';
            data['site']    = '<?=object('application')->getSite();?>';
            data['_token'] = '<?=$this->getObject('user')->getSession()->getToken()?>';
            if($('#subscription').hasClass('btn-unsubscribed')){
                data['_method'] = 'delete';
            }

            var request =jQuery.post('index.php?option=com_fora&view=subscription', data);
            request.done(function(res){
                $('#subscription').toggleClass('btn-unsubscribed').toggleClass('btn-subscribed');
                $('#subscription').html($('#subscription').hasClass('btn-unsubscribed') ? 'Unsubscribe' : 'Subscribe');

            });

        })

    });
</script>