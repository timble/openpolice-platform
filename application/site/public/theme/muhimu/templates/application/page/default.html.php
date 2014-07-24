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
$singleColumn = $extension == 'police' OR $extension == 'files' ? 'true' : 'false';

$pages = object('com:pages.model.pages')->menu('1')->published('true')->getRowset();

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
?>
<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>" prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#"">
<?= import('page_head.html') ?>
<body id="page">
<script data-inline type="text/javascript" pagespeed_no_defer>document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');</script>

<div id="wrapper">
    <div class="container__top">
        <div class="organization" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="<?= $path ?>">
                <span class="organization__logo"></span>
                <span class="organization__name">
                    <span><?= translate('Police') ?></span> <?= escape($zone->title); ?>
                </span>
                <meta itemprop="logo" content="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.png" />
            </a>
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="Wat wilt u vinden?" />
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

    <div class="container__content<?= $extension == 'police' ? ' homepage' : '' ?>">
        <ktml:modules position="left">
            <aside class="sidebar">
                <ktml:modules:content>
            </aside>
        </ktml:modules>

        <? if(!$singleColumn) : ?>
        <div class="component <?= $extension ?>">
            <? endif ?>
            <ktml:content>
                <? if(!$singleColumn) : ?>
        </div>
    <? endif ?>
    </div>

</div>

<footer class="copyright">
    <div class="container__copyright">
        <div class="copyright--left">
            <a href="#">Contact</a>
            <? if($zone->twitter) : ?>
                <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a>
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a>
            <? endif ?>
            <? foreach($pages as $page) : ?>
                <? if($page->id == '89' || $page->id == '101') : ?>
                    <a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a>
                <? endif ?>
            <? endforeach ?>
        </div>
        <div class="copyright--right">
            © <?= date(array('format' => 'Y')) ?> <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $active->slug ?>/disclaimer.html">Disclaimer</a>
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $active->slug ?>/privacy.html">Privacy</a>
            <a href=#" class="active">NL</a> - <a href="#">FR</a>
        </div>
    </div>
</footer>

</body>
</html>