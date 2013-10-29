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
        <a class="<?= $state->topic == null ? 'active' : ''; ?>" href="<?= route('topic=' ) ?>">
            <?= 'All topics' ?>
        </a>
    </li>
    <? foreach ($topics as $topic) : ?>
        <li>
            <a class="<?= $state->topic == $topic->id ? 'active' : ''; ?>" href="<?= route('topic='.$topic->id ) ?>">
                <?= escape($topic->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>