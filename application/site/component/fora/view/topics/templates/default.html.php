<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title content="replace"><?= translate('Search') ?></title>


<form action="<?= helper('route.search'); ?>" method="get" class="form-search well">
    <input type="hidden" name="forum" value="<?= $state->forum; ?>"/>
    <div class="input-append">
        <input id="searchword" name="searchword" class="input-xxlarge search-query" type="text"
               value="<?= escape($state->searchword) ?>" placeholder="<?= translate('Search this forum') ?>"/>
        <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i></button>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th><?= translate('Title') ?></th>
        <th nowrap><?= translate('Created') ?></th>
    </tr>
    </thead>
    <? foreach($topics as $topic): ?>
        <tr>
            <td width="100%">
                <a href="<?= helper('route.topic', array('row' => $topic)) ?>">
                    <?=$topic->title;?>
                </a>
            </td>
            <td nowrap>
                <?= helper('date.humanize', array('date' => $topic->created_on)) ?> <?= translate('by') ?> <?= $topic->created_by_name; ?>
            </td>
        </tr>
    <? endforeach; ?>
</table>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>