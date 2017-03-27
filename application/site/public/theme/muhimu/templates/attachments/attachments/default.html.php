<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $list = (isset($row) && isset($table)) ? $attachments->find(array('row' => $row, 'table' => $table)) : $attachments ?>

<? if(count($list) > '1' || (count($list) == '1' && reset($exclude) == '0')) : ?>
    <ul class="gallery">
        <? foreach($list as $item) : ?>
            <? if($item->file->isImage() && !in_array($item->id, Nooku\Library\ObjectConfig::unbox($exclude))) : ?>
                <li class="gallery__item">
                    <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="thumbnail" href="attachments://<?= $item->path; ?>">
                        <img width="640px" src="attachments://<?= $item->thumbnail ?>" />
                    </a>
                </li>
            <? endif ?>
        <? endforeach ?>
    </ul>

    <ul>
        <? foreach($list as $item) : ?>
            <? if(!$item->file->isImage()) : ?>
                <li><a onClick="ga('send', 'event', 'Attachments', 'Download', '<?=escape($item->name)?>');" href="attachments://<?= $item->path; ?>"><?= escape($item->name) ?></a> (<?= helper('com:files.filesize.humanize', array('size' => $item->file->size));?>, <?= $item->file->extension ?>)</li>
            <? endif ?>
        <? endforeach ?>
    </ul>
<? endif ?>
