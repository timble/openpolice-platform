<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? $list = (isset($row) && isset($table)) ? $attachments->find(array('row' => $row, 'table' => $table)) : $attachments ?>

<?
if(count($list) > '1' || (count($list) == '1' && reset($exclude) == '0')) {
    $images = array();
    $documents = array();

    foreach($list as $item) {
        if($item->file->isImage() && !in_array($item->id, Nooku\Library\ObjectConfig::unbox($exclude)))
        {
            $images[] = $item;
        } elseif (!$item->file->isImage()) {
            $documents[] = $item;
        }
    }
}
?>

<? if(count($list) > '1' || (count($list) == '1' && reset($exclude) == '0')) : ?>
    <? if($images) : ?>
    <ul class="gallery">
        <? foreach($images as $item) : ?>
        <li class="gallery__item">
            <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="thumbnail" data-gallery="enabled" href="attachments://<?= $item->path; ?>">
                <img width="640px" src="attachments://<?= $item->thumbnail ?>" />
            </a>
        </li>
        <? endforeach ?>
    </ul>
    <? endif ?>

    <? if($documents) : ?>
    <div class="well">
        <h2 id="#<?= strtolower(translate('Attachments')); ?>"><?= translate('Attachments'); ?></h2>
        <ul>
            <? foreach($documents as $item) : ?>
                <?
                preg_match('/(.*)\.([^.]*)$/', $item->name, $matches);

                if (count($matches) === 3) {
                    $name = $matches[1];
                } else $name = $item->name;
                ?>
                <li><a onClick="ga('send', 'event', 'Attachments', 'Download', '<?=escape($item->name)?>');" href="attachments://<?= $item->path; ?>"><?= escape($name) ?> (<?= $item->file->extension ?>, <?= helper('com:files.filesize.humanize', array('size' => $item->file->size));?>)</a></li>
            <? endforeach ?>
        </ul>
    </div>
    <? endif ?>
<? endif ?>