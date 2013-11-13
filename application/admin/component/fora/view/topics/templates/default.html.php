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

<div id="com_fora">
<div id="fora-topics-default">
    <div class="well well-small">
        <form action="" method="get" name="search">
            <input name="search" type="text" placeholder="<?= translate('Search the forums ..') ?>" value="<?= $state->search ? escape($state->search) : null ?>" autofocus="autofocus" />
            <input class="btn primary" type="submit" value="Search" disabled="disabled" />
        </form>
    </div>

    <div class="well well-small">
        <div class="well__content">

            <div class="media__items">
                <? foreach($topics as $topic) : ?>
                    <?= import('default_items.html', array('topic' => $topic)); ?>
                <? endforeach ?>
            </div>

            <? if(!$total) : ?>
                <? if(!$state->search) : ?>
                    <p><?= translate('This forum does not contain any topics yet') ?>.</p>

                        <a class="btn btn-primary btn-small" href="<?= route('view=topic&layout=form&forum='.$state->forum) ?>">
                            <?= translate('Start a new') ?>
                            <? // translate('Start a new').' '.translate($forum->type) ?>
                        </a>

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