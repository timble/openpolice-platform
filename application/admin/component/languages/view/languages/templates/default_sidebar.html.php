<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Applications') ?></h3>
<ul class="navigation">
    <li>
        <a class="<?= $state->application == 'admin' ? 'active' : '' ?>" href="<?= route('application=admin') ?>">
            <?= translate('Administrator') ?>
        </a>
    </li>
    <li>
        <a class="<?= $state->application == 'site' ? 'active' : '' ?>" href="<?= route('application=site') ?>">
            <?= translate('Site') ?>
        </a>
    </li>
</ul>