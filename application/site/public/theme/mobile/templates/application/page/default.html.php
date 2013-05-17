<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $columns = @helper('module.count', array('condition' => 'left')) ? '9' : '12' ?>
<? $zone = @object('com:police.model.zone')->id(@object('application')->getCfg('site' ))->getRow() ?>
<? $site = @escape(@object('application')->getCfg('site' )) ?>
<? if($component == 'police') { $columns = '12'; } ?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= @template('page_head.html') ?>
<body>
<div id="wrap" class="container">
    <div class="section-header">
        <div class="row-fluid">
            <div class="span3">
                <div class="logo" itemscope itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="/<?= $site ?>">
                        <img itemprop="logo" src="media://application/images/logo-nl.png" />
                        <span><?= @escape($zone->title); ?></span>
                    </a>
                </div>
            </div>
            <div class="span9 navbar navbar-responsive">
                <a class="logo-mobile" href="/<?= $site ?>">
                    <img src="media://application/images/logo-flame.png" />
                    <span><?= @escape($zone->title); ?></span>
                </a>
                <span class="slogan hidden-phone">Bel <strong>101</strong> als elke seconde telt. Geen spoed, wél politie? Bel <strong><?= @escape($zone->telephone); ?></strong></span>
                <div class="navbar-inner">
                    <ktml:modules position="navigation">
                        <ktml:modules:content />
                    </ktml:modules>
                </div>
            </div>
        </div>
    </div>

    <ktml:modules position="telephone">
        <ktml:modules:content />
    </ktml:modules>

    <div class="section-banner banner5388">

    </div>

    <div class="container-breadcrumb">
        <ktml:modules position="breadcrumbs">
            <ktml:modules:content />
        </ktml:modules>
    </div>

    <div class="container-content <?= $component ?>">
        <div class="row">
            <ktml:modules position="left">
                <div class="span3 sidebar hidden-phone">
                    <ktml:modules:content />
                </div>
            </ktml:modules>
            <div class="span<?= $columns ?>">
                <ktml:content />
            </div>
        </div>
    </div>

    <div class="container-media">
        <div class="row">
            <div class="span6 hidden-phone">
                <h3><?= @text('Laatste nieuws') ?></h3>
                <?= @template('com:news.view.articles.list.html', array('articles' =>  @object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->limit('2')->getRowset())) ?>
            </div>
            <div class="span3 hidden-phone">
                <h3><?= @text('Meer weten') ?></h3>
                <ktml:modules position="footermenu">
                    <ktml:modules:content />
                </ktml:modules>
            </div>
            <div class="span3">
                <h3 class="hidden-phone">Volg ons via</h3>
                <ul class="social">
                    <li class="social__item">
                        <span class="icon-stack">
                          <i class="icon-circle icon-stack-base icon-blue"></i>
                          <i class="icon-twitter icon-light"></i>
                        </span>
                        <a href="http://www.twitter.com/politieleuven">Twitter</a>
                    </li>
                    <li class="social__item">
                        <span class="icon-stack">
                          <i class="icon-circle icon-stack-base icon-blue"></i>
                          <i class="icon-facebook icon-light"></i>
                        </span> <a href="http://www.facebook.com/politieleuven">Facebook</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="push"></div>
</div>

<div class="container container-copyright">
    <p>
        © 2013 Lokale Politie - <?= @escape($zone->title); ?>
        <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/nl/disclaimer.html">Disclaimer</a> -
        <a target="_blank" href="http://www.lokalepolitie.be/portal/nl/privacy.html">Privacy</a>
        <a style="margin-left: 10px" target="_blank" href="http://www.belgium.be"><image src="media://application/images/icon_belgium.gif" /></a>
    </p>
</div>

</body>
</html>