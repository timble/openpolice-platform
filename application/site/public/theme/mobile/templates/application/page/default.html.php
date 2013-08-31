<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $zone = object('com:police.model.zone')->id($site)->getRow() ?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= import('page_head.html') ?>
<body>
<div id="wrap" class="container-fluid">
    <div class="container-header">
        <div class="row-fluid">
            <div class="span3 alpha">
                <div class="logo" itemscope itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="/<?= $site ?>">
                        <img itemprop="logo" src="assets://application/images/logo-nl.jpg" />
                        <div><?= escape($zone->title); ?></div>
                    </a>
                </div>
            </div>
            <div class="span9">
                <span class="slogan">Bel <a class="text--strong" href="tel:101">101</a> voor dringende politiehulp. Geen spoed, wél politie? Bel <a class="text--strong" href="tel:<?= escape($zone->telephone); ?>"><?= escape($zone->telephone); ?></a></span>
                <div class="navbar">
                    <div class="navbar__handlebar">
                        <div class="navbar__handle">&equiv;</div>
                        <a class="navbar__logo" href="/<?= $site ?>">
                            <img src="assets://application/images/logo-flame.png" />
                            <?= escape($zone->title); ?>
                        </a>
                    </div>
                    <ktml:modules position="navigation">
                        <ktml:modules:content>
                    </ktml:modules>
                </div>
            </div>
        </div>
    </div>

    <div class="container-banner banner5388">
        <div class="row-fluid">
            <div class="span12 alpha">
                <img src="assets://application/images/banners/<?= $site ?>.jpg" />
            </div>
        </div>
    </div>
    <ktml:modules position="breadcrumbs">
    <div class="container-breadcrumb">
        <div class="row-fluid">
            <div class="span12 alpha">
                <ktml:modules:content>
            </div>
        </div>
    </div>
    </ktml:modules>

    <div class="container-content <?= $extension ?>">
        <div class="row-fluid">
            <? if($extension !== 'police') : ?>
            <aside class="span3 alpha sidebar">
                <ktml:modules position="left">
                    <ktml:modules:content>
                </ktml:modules>
            </aside>
            <? endif; ?>
            <div class="span<?= $extension == 'police' ? '12 alpha' : '9' ?> component">
                <ktml:content>
            </div>
        </div>
    </div>

    <div class="container-footer">
        <div class="row-fluid">
            <div class="span8 alpha">
                <h3><?= translate('Laatste nieuws') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <div class="span4">
                <h3>Je wijkinspecteur</h3>
                <?= import('default_district.html') ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container-copyright">
    <div class="row-fluid">
        <div class="span6 alpha">
            <a href="http://www.twitter.com/politieleuven"><i class="icon-twitter"></i> Twitter</a> | <a href="http://www.facebook.com/politieleuven"><i class="icon-facebook"></i> Facebook</a>
        </div>
        <div class="span6 copyright">
            © 2013 Lokale Politie - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/nl/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/nl/privacy.html">Privacy</a>
            <a style="margin-left: 10px" href="http://www.belgium.be"><image src="assets://application/images/icon_belgium.gif" /></a>
        </div>
    </div>
    </div>
</div>

</body>
</html>