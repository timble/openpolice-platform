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
        <a class="<?= $state->contact == null ? 'active' : ''; ?>" href="<?= route('contact=' ) ?>">
            <?= 'All contacts' ?>
        </a>
    </li>
    <? foreach ($contacts as $contact) : ?>
        <li>
            <a class="<?= $state->contact == $contact->id ? 'active' : ''; ?>" href="<?= route('contact='.$contact->id ) ?>">
                <span class="navigation__text"><?= escape($contact->name) ?></span>
            </a>
        </li>
    <? endforeach ?>
</ul>