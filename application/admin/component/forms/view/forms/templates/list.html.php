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
        <a class="<?= $state->form == null ? 'active' : ''; ?>" href="<?= route('form=' ) ?>">
            <?= translate('All forms') ?>
        </a>
    </li>
    <? foreach ($forms as $form) : ?>
        <li>
            <a class="<?= $state->form == $form->id ? 'active' : ''; ?>" href="<?= route('form='.$form->id ) ?>">
                <?= escape($form->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>