<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if(count($messages)) : ?>
    <? foreach ($messages as $type => $message) : ?>
        <div class="alert alert-<?= strtolower($type) ?>">
            <? foreach ($message as $line) : ?>
                <?= $line ?>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
<? endif; ?>