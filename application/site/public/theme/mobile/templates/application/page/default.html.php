<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $site = @escape(@object('application')->getCfg('site' )) ?>
<? $zone = @object('com:police.model.zone')->id($site)->getRow() ?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= @template('page_head.html') ?>
<body>
<div id="wrap" class="container-fluid">
    <div class="container-header">
        <div class="row-fluid">
            <div class="span3">
                <div class="logo" itemscope itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="/<?= $site ?>">
                        <img itemprop="logo" src="media://application/images/logo-nl.png" />
                        <span><?= @escape($zone->title); ?></span>
                    </a>
                </div>
            </div>
            <div class="span9">
                <span class="slogan hidden-phone">Bel <a class="text--strong" href="tel:101">101</a> voor dringende politiehulp. Geen spoed, wél politie? Bel <a class="text--strong" href="tel:<?= @escape($zone->telephone); ?>"><?= @escape($zone->telephone); ?></a></span>
                <div class="navbar navbar-responsive">
                    <div class="navbar-inner">
                        <ktml:modules position="navigation">
                            <ktml:modules:content />
                        </ktml:modules>
                    </div>
                    <a class="navbar__logo" href="/<?= $site ?>">
                        <img src="media://application/images/logo-flame.png" />
                        <span><?= @escape($zone->title); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-banner banner5388">
        <img src="media://application/images/banners/<?= $site ?>.jpg" />
    </div>

    <div class="container-breadcrumb hidden-phone">
        <ktml:modules position="breadcrumbs">
            <ktml:modules:content />
        </ktml:modules>
    </div>

    <div class="container-content <?= $extension ?>">
        <div class="row-fluid">
            <? if($extension !== 'police') : ?>
            <div class="span3 sidebar hidden-phone">
                <ktml:modules position="left">
                    <ktml:modules:content />
                </ktml:modules>
                <? if(!@helper('module.count', array('condition' => 'left'))) : ?>
                <?= @template('com:police.view.page.homepage_shortcuts.html', array('class' => 'sidebar__element')) ?>
                <? endif ?>
            </div>
            <? endif; ?>
            <div class="span<?= $extension == 'police' ? '12' : '9' ?> component">
                <ktml:content />
            </div>
        </div>
    </div>

    <div class="container-footer hidden-phone">
        <div class="row-fluid">
            <div class="span6">
                <h3><?= @text('Laatste nieuws') ?></h3>
                <?= @template('com:news.view.articles.list.html', array('articles' =>  @object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('3')->getRowset())) ?>
            </div>
            <div class="span3">
                <h3 style="padding-left: 12px" ><?= @text('Meer weten') ?></h3>
                <ktml:modules position="footermenu">
                    <ktml:modules:content />
                </ktml:modules>
            </div>
            <div class="span3">
                <h3>Mijn wijkinspecteur</h3>
                <?= @template('default_district.html') ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container-copyright">
    <div class="row-fluid">
        <div class="span6">
            <a href="http://www.twitter.com/politieleuven"><i class="icon-twitter"></i> Twitter</a> | <a href="http://www.facebook.com/politieleuven"><i class="icon-facebook"></i> Facebook</a>
        </div>
        <div class="span6 copyright hidden-phone">
            © 2013 Lokale Politie - <?= @escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/nl/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/nl/privacy.html">Privacy</a>
            <a style="margin-left: 10px" target="_blank" href="http://www.belgium.be"><image src="media://application/images/icon_belgium.gif" /></a>
        </div>
    </div>
    </div>
</div>

</body>
</html>