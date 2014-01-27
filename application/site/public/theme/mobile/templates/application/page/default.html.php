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
$zone = object('com:police.model.zone')->id($site)->getRow();
$language_short = explode("-", $language);
$language_short = $language_short[0];
?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>" prefix="og: http://ogp.me/ns#">

<?= import('page_head.html') ?>
<body id="page" class="no-js">
<script data-inline type="text/javascript" pagespeed_no_defer="">function hasClass(e,t){return e.className.match(new RegExp("(\\s|^)"+t+"(\\s|$)"))}var el=document.getElementById("page");var cl="no-js";if(hasClass(el,cl)){var reg=new RegExp("(\\s|^)"+cl+"(\\s|$)");el.className=el.className.replace(reg,"js-enabled")}</script>

<div id="wrap">
    <div class="container container__header">
        <div class="logo" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/<?= $site ?>">
                <img width="160" height="42" itemprop="logo" alt="<?= translate('Police') ?> logo" src="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.jpg" />
                <div><?= escape($zone->title); ?></div>
            </a>
        </div>

        <div class="navigation">
            <span class="slogan">
                <?= JText::sprintf('Call for urgent police assistance', '101', '101') ?>.
                <?= JText::sprintf('No emergency, just police', escape(str_replace(' ', '', $zone->phone_emergency)), escape($zone->phone_emergency)) ?>.
            </span>
            <div class="navbar">
                <div class="navbar__handlebar">
                    <div class="navbar__handle">&equiv;</div>
                    <a class="navbar__logo" href="/<?= $site ?>">
                        <?= translate('Police') ?>
                        <?= escape($zone->title); ?>
                    </a>
                </div>
                <ktml:modules position="navigation">
                    <ktml:modules:content>
                </ktml:modules>
            </div>
        </div>
    </div>

    <div class="container container__banner">
        <img width="890" height="110" src="assets://application/images/banners/<?= $site ?>.jpg" alt="<?= translate('Police') ?> <?= escape($zone->title); ?> banner" />
    </div>

    <ktml:modules position="breadcrumbs">
    <div class="container container__breadcrumb">
        <ktml:modules:content>
    </div>
    </ktml:modules>

    <div class="container container__content <?= $extension ?>">
        <ktml:modules position="left">
        <aside class="sidebar">
            <ktml:modules:content>
        </aside>
        </ktml:modules>

        <div class="<?= ($extension == 'police' OR $extension == 'files') ? 'homepage' : 'component' ?>">
            <ktml:content>
        </div>
    </div>

    <div class="container container__footer">
        <div class="row">
            <div class="footer__news">
                <h3><?= translate('Latest news') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <div class="footer__districts">
                <h3><?= translate('Your district officer') ?></h3>
                <?= import('default_district.html') ?>
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container container__copyright">
        <div class="copyright--left">
            <? if($zone->twitter) : ?>
                <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a> |
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a> |
            <? endif ?>
            <a href="/<?= $site ?>/downloads">Downloads</a>
        </div>
        <div class="copyright--right">
            © 2013 <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
            <a href="http://www.belgium.be">Belgium.be</a>
        </div>
    </div>
</div>



</body>
</html>