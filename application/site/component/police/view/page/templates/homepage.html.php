<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>
<?
$site = object('application')->getCfg('site');
$zone = object('com:police.model.zone')->id($site)->getRow();

$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';

if ($site == 'fed')
{
    $description = translate('Website of the Federal Police');
} else {
    $cities = object('com:streets.model.cities')->zone($site)->getRowset()->title;

    $description = translate('Website of the local Police zone').' '.$zone->title;

    if(count($cities) > '1')
    {
        $description .= ' (';
        $description .= implode(", ", $cities);
        $description .= ')';
    }
}
?>

<meta content="<?= $description ?>." name="description" />

<div class="clearfix">
    <div class="homepage__sticky">
        <? $stickies = object('com:news.model.articles')->sticky(true)->published(true)->getRowset();
            $article = $stickies->count() ? $stickies->top() : object('com:news.model.articles')->limit('1')->sort('published_on')->direction('DESC')->published(true)->getRowset()->top(); ?>
        <? $link = $path.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
        <article>
            <header class="article__header">
                <h1><a href="<?= $link ?>"><?= escape($article->title) ?></a></h1>
                <span class="text--small">
                    <?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC5'))) ?>
                </span>
            </header>

            <div class="clearfix">
                <? if($article->attachments_attachment_id) : ?>
                    <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
                        <?= helper('com:police.image.thumbnail', array(
                            'attachment' => $article->attachments_attachment_id,
                            'attribs' => array('width' => '400', 'height' => '300'))) ?>
                    </a>
                <? endif ?>

                <?= $article->introtext ?>

                <? if ($article->fulltext) : ?>
                    <a href="<?= $link ?>"><?= translate('Read more') ?></a>
                <? endif; ?>
            </div>
        </article>
        <div class="homepage__news">
            <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('published_on')->direction('DESC')->published(true)->limit('2')->exclude($article->id)->getRowset())) ?>
        </div>
    </div>
    <div class="homepage__contact">
        <div class="contact__inner">
            <h3><?= translate('Contact us') ?></h3>
            <div class="well well--small">
                <p>
                    <span class="muted"><?= translate('Urgent police assistance') ?></span><br />
                    <span class="text--strong text--primary">101</span>
                    <? if($zone->phone_emergency) : ?>
                    <?= @translate('or') ?> <span class="text--strong text--primary"><?= $zone->phone_emergency ?></span>
                    <? endif ?>
                </p>
                <? if($zone->phone_information) : ?>
                <p>
                    <span class="muted"><?= translate('General information') ?></span><br />
                    <span class="text--strong text--primary"><?= $zone->phone_information ?></span>
                </p>
                <? endif ?>
            </div>

            <ul class="nav nav--list">
                <? foreach(object('com:pages.model.pages')->menu('1')->published('true')->hidden('false')->getRowset() as $page) : ?>
                    <? if(in_array($page->id, array('42', '43', '44', '66'))) : ?>
                    <li><a href="<?= $path ?>/<?= object('lib:filter.slug')->sanitize(translate('Contact')) ?>/<?= $page->slug ?>"><?= $page->title ?></a></li>
                    <? endif ?>
                <? endforeach ?>
            </ul>
        </div>
    </div>
</div>
