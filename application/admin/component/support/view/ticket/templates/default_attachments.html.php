<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright    Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license        GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link        https://github.com/timble/openpolice-platform
 */
?>

<? $list = (isset($row) && isset($table)) ? $attachments->find(array('row' => $row, 'table' => $table)) : $attachments ?>

<? if (count($list)) : ?>
    <?= helper('behavior.mootools') ?>
    <?= helper('behavior.modal') ?>

    <? foreach ($list as $item) : ?>
        <? if ($item->file->isImage()) : ?>
            <a class="modal attachment"
               href="files/<?= $this->getObject('application')->getSite() ?>/attachments/<?= $item->path ?>"
               rel="{handler: 'image'}"><?= escape($item->name) ?></a>
        <? else : ?>
            <a class="attachment" href="files/<?= $this->getObject('application')->getSite() ?>/attachments/<?= $item->path ?>" download="<?= escape($item->name) ?>"><?= escape($item->name) ?></a>
        <? endif ?>
    <? endforeach ?>
<? endif ?>