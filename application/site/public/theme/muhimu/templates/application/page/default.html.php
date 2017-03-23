<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>
<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$zone = object('com:police.model.zone')->id($site)->getRow();

$pages = object('com:pages.model.pages')->menu('1')->published('true')->getRowset();

$extensionViewLayout = $extension.'-'.$view.'-'.$layout;
?>
<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>" prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#">
<?= import('page_head.html') ?>
<body id="page" class="<?= $extension ?> <?= $view ?>">
<script data-inline type="text/javascript" pagespeed_no_defer>document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');</script>

<div id="wrapper">
    <div class="skip">
        <div class="container__skip">
            <a href="#content">Skip to main content</a>
        </div>
    </div>
    <div class="container__top">
        <div class="organization" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/">
                <span class="organization__logo"></span>
                <span class="organization__name">
                    <span><?= $zone->title ? escape($zone->title) : 'Open Police'; ?></span>
                </span>
                <meta itemprop="logo" content="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.png" />
            </a>
        </div>
        <? if($extensionViewLayout == 'police-page-homepage') : ?>
        <form class="search" action="/search">
            <a id="toggle-search" class="toggle-search" href="#" aria-pressed="false" onclick="apollo.toggleClass(document.getElementById('search-input'), 'is-shown');toggler()">

            </a>
            <div id="search-input" class="search-input">
                <input type="search" placeholder="<?= translate('Search') ?>" />
                <button type="submit" />
            </div>
        </form>
        <? endif ?>
    </div>

    <ktml:modules position="breadcrumbs">
        <div class="container__breadcrumb">
            <?= @import('default_languages.html', array('languages' => $languages, 'active' => $active)) ?>
            <ktml:modules:content>
        </div>
    </ktml:modules>

    <div id="content" class="container__content<?= $extensionViewLayout == 'police-page-homepage' ? ' homepage' : '' ?>">
        <? $class = !in_array($extensionViewLayout, array('police-page-homepage', 'police-page-catalogue', 'districts-district-default', 'news-articles-default', 'press-articles-default')) ? ' component--sidebar' : '' ?>
        <div class="component<?= $class ?>">
            <ktml:content>
        </div>
        <ktml:modules position="sidebar">
            <aside class="sidebar">
                <ktml:modules:content>
            </aside>
        </ktml:modules>
    </div>

</div>

<footer class="copyright">
    <div class="container__copyright">
        <div class="copyright__menu">
            <? foreach($pages as $page) : ?>
                <? if(in_array($page->id, array('89', '101', '41', '106', '107'))) : ?>
                    <a href="/<?= $page->slug ?>"><?= $page->title ?></a>
                <? endif ?>
            <? endforeach ?>
            Built by <a href="https://www.timble.net/platform/open-police/">Timble</a>
            <? if($zone->twitter) : ?>
                <a href="//www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a>
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="//www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a>
            <? endif ?>
        </div>
        <div class="text--small">
            All code is available under a free software license on <a href="https://github.com/timble/openpolice-platform">GitHub</a>.
        </div>
    </div>
</footer>

</body>
</html>
