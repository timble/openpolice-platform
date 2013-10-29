<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<ul class="navigation">
    <li>
        <a class="<?= $state->forum == null ? 'active' : ''; ?>" href="<?= route('forum=' ) ?>">
            <?= 'All forums' ?>
        </a>
    </li>
    <? foreach ($forums as $forum) : ?>
        <li>
            <a class="<?= $state->forum == $forum->id ? 'active' : ''; ?>" href="<?= route('forum='.$forum->id ) ?>">
                <?= escape($forum->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>