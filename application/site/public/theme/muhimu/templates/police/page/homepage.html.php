<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$site = object('application')->getCfg('site');
$pages = object('com:pages.model.pages')->menu('1')->published('true')->getRowset();

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
        <p class="phone_numbers">Bel <strong>101</strong> voor dringende politiehulp. Geen spoed, wél politie? Bel <strong>016 21 06 11</strong>.</p>
        <div class="quick_links">
            <ul>
                <li><a href="#">Aangifte of melding doen</a></li>
                <li><a href="#">Je wijkinspecteur zoeken</a></li>
                <li><a href="#">Contacteer ons</a></li>
            </ul>
        </div>
        <div class="mijn_politie">
            Mijn politie
        </div>
    </div>
</ktml:module>

<div class="container__sections">
<? foreach($pages as $page) : ?>
    <? if($page->level == '1' && $page->hidden == false) : ?>
    <section class="section">
        <h1><a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a></h1>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Lorem ipsum dolor sit amet.</p>
    </section>
    <? endif ?>
<? endforeach ?>
</div>

<hr class="divider" />

<div class="container__news">
    <section class="news">
        <div class="news__image">
            <div class="news__image__content"></div>
        </div>
        <div class="news__content">
            <h2>Koester je buren</h2>
            <p>Tijdens de zomerse dagen kom je mekaar sneller tegen en is een vriendelijke goedendag en praatje met de buren best aangenaam.</p>
        </div>
    </section>
    <section class="news">
        <div class="news__image">
            <div class="news__image__content"></div>
        </div>
        <div class="news__content">
            <h2>Koester je buren</h2>
            <p>Tijdens de zomerse dagen kom je mekaar sneller tegen en is een vriendelijke goedendag en praatje met de buren best aangenaam.</p>
        </div>
    </section>
    <section class="news">
        <div class="news__image">
            <div class="news__image__content"></div>
        </div>
        <div class="news__content">
            <h2>Koester je buren</h2>
            <p>Tijdens de zomerse dagen kom je mekaar sneller tegen en is een vriendelijke goedendag en praatje met de buren best aangenaam.</p>
        </div>
    </section>
    <section class="news">
        <div class="news__image">
            <div class="news__image__content"></div>
        </div>
        <div class="news__content">
            <h2>Koester je buren</h2>
            <p>Tijdens de zomerse dagen kom je mekaar sneller tegen en is een vriendelijke goedendag en praatje met de buren best aangenaam.</p>
        </div>
    </section>
</div>