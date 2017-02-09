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

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
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
            <a itemprop="url" href="<?= $path ?>">
                <span class="organization__logo"></span>
                <span class="organization__name">
                    <span><?= $zone->title ? escape($zone->title) : 'Open Police'; ?></span>
                </span>
                <meta itemprop="logo" content="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.png" />
            </a>
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="<?= translate('Search') ?>" />
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

    <div id="content" class="container__content<?= $extension == 'police' ? ' homepage' : '' ?>">
        <? $extension_view = $extension.'-'.$view; ?>
        <? $class = in_array($extension_view, array('police-page', 'files', 'districts-relations', 'districts-district', 'news-articles', 'press-articles')) ? ' component--no-sidebar' : '' ?>
        <div class="component <?= $class ?>">
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
        <div class="copyright--left">
            <? foreach($pages as $page) : ?>
                <? if($page->id == '89' || $page->id == '101' || $page->id == '41') : ?>
                    <a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a>
                <? endif ?>
            <? endforeach ?>
            <? if($zone->twitter) : ?>
                <a href="//www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a>
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="//www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a>
            <? endif ?>
        </div>
        <div class="copyright--right">
            © <?= date(array('format' => 'Y')) ?> <?= escape($zone->title); ?>
            <div class="copyright__menu">
                <a style="margin-left: 10px" href="#">Disclaimer</a>
                <a target="_blank" href="#">Privacy</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
