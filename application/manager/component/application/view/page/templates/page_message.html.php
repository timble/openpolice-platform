<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if(count($messages)) : ?>
    <? foreach ($messages as $type => $message) : ?>
        <div class="alert alert-<?= strtolower($type) ?>">
            <? foreach ($message as $line) : ?>
                <div class="alert__text"><?= $line ?></div>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
<? endif; ?>