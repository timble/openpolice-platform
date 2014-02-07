<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? $list = (isset($row) && isset($table)) ? $attachments->find(array('row' => $row, 'table' => $table)) : $attachments ?>

<? if(count($list)) : ?>
    <?= helper('behavior.mootools') ?>
    <?= helper('behavior.modal') ?>

    <ul>
        <? foreach($list as $item) : ?>
        <li>
            <? if($item->file->isImage()) : ?>
            <a class="modal" href="files/<?= $this->getObject('application')->getSite() ?>/attachments/<?= $item->path ?>" rel="{handler: 'image'}"><?= escape($item->name) ?></a>
            <? else : ?>
            <a href="<?= route('view=attachment&format=file&id='.$item->id) ?>"><?= escape($item->name) ?></a>
            <? endif ?>
        </li>
        <? endforeach ?>
    </ul>
<? endif ?>