<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
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
        <div class="search" action="/search">
            <? if($extensionViewLayout != 'police-page-homepage') : ?>
            <button id="toggle-search" class="toggle-search" href="#" aria-pressed="false" onclick="apollo.toggleClass(document.getElementById('search-input'), 'is-shown');apollo.toggleClass(document.getElementById('toggle-search'), 'is-pressed');document.getElementById('search-input-field').focus();toggler()"></button>
            <? endif ?>
            <form id="search-input" class="search-input<?= $extensionViewLayout == 'police-page-homepage' ? ' is-shown' : '' ?>" action="/search">
                <input id="search-input-field" type="search" placeholder="<?= translate('Search') ?>" />
                <button type="submit" />
            </form>
        </div>
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

<footer class="footer">
    <div class="container__footer">
        <div class="footer--group">
            <div class="footer--left footer__menu">
                <ul>
                    <? foreach($pages as $page) : ?>
                        <? if(in_array($page->id, array('89', '101', '41', '106', '107'))) : ?>
                            <li>
                                <a href="/<?= $page->slug ?>"><?= $page->title ?></a>
                            </li>
                        <? endif ?>
                    <? endforeach ?>
                    <li>
                        Built by <a href="https://www.timble.net/platform/open-police/">Timble</a>
                    </li>
                </ul>

            </div>
            <div class="footer--right footer__menu footer__menu--social">
                <ul>
                    <? if($zone->twitter) : ?>
                    <li>
                        <a href="//twitter.com/<?= $zone->twitter ?>">
                            <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"/></svg>
                            <!--[if lt IE 9]>Twitter<![endif]-->
                        </a>
                    </li>
                    <? endif ?>
                    <? if($zone->facebook) : ?>
                    <li>
                        <a href="//www.facebook.com/<?= $zone->facebook ?>">
                            <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"/></svg>
                            <!--[if lt IE 9]>Facebook<![endif]-->
                        </a>
                    </li>
                    <? endif ?>
                </ul>
            </div>
        </div>
        <div class="text--small">
            All code is available under a free software license on <a href="https://github.com/timble/openpolice-platform">GitHub</a>.
        </div>
    </div>
</footer>

</body>
</html>
