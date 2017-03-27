<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?
$site = object('application')->getCfg('site');

$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
?>

<? foreach ($articles as $article) : ?>
    <? $link = $path.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <div class="media">
        <? if($article->attachments_attachment_id): ?>
            <a tabindex="-1" class="thumbnail media__object" href="<?= $link ?>">
                <?= helper('com:police.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '64', 'height' => '48'))) ?>
            </a>
        <? endif; ?>
        <div class="media__body">
            <a class="media__heading" href="<?= $link ?>"><?= escape($article->title) ?></a>
            <div class="text--small">
                <?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC5'))) ?>
            </div>
        </div>
    </div>
<? endforeach; ?>
