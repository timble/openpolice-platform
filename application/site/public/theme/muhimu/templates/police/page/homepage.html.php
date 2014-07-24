<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$site = object('application')->getCfg('site');
$pages = object('com:pages.model.pages')->menu('1')->sort('title')->direction('ASC')->published('true')->getRowset();

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
?>

<style type="text/css">
    .breadcrumb {
        display: none;
    }
</style>

<ktml:module position="breadcrumbs">
    <div class="container__header">
        <div class="quick_links">
            <p class="phone_numbers">Bel <strong>101</strong> voor dringende politiehulp. Geen spoed, wél politie? Bel <strong>016 21 06 11</strong>.</p>
            <ul>
                <li><a href="#">Aangifte of melding doen</a></li>
                <li><a href="#">Je wijkinspecteur zoeken</a></li>
                <li><a href="#">Contacteer ons</a></li>
            </ul>
        </div>
        <div class="my_police">
            <h2 class="my_police__header">Mijn<span>Politie</span></h2>
            <p>Gepersonaliseerd politienieuws en verkeersinformatie uit jouw buurt.</p>
            <p><a href="#" class="my_police__button">Voer nu je straatnaam in</a></p>
            <p class="margin-zero"><a href="#">Meer informatie over “mijn politie”</a></p>
        </div>
    </div>
</ktml:module>

<div class="container__sections">
<? foreach($pages as $page) : ?>
    <? if($page->level == '1' && $page->hidden == false) : ?>
    <section class="section">
        <h1><a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a></h1>
        <p><?= $page->getParams('page')->get('description') ?></p>
    </section>
    <? endif ?>
<? endforeach ?>
</div>

<hr class="divide" />

<div class="container__news">
<? foreach(object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('4')->getRowset() as $article) : ?>
    <section class="news">
        <div class="news__image">
            <div class="news__image__content">
                <?= helper('com:attachments.image.thumbnail', array(
                'attachment' => $article->attachments_attachment_id,
                'attribs' => array('width' => '400', 'height' => '300'))) ?>
            </div>
        </div>
        <div class="news__content">
            <h2><a href="#"><?= $article->title ?></a></h2>
            <?= $article->introtext ?>
        </div>
    </section>
<? endforeach ?>
</div>