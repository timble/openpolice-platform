<?
    $zone = object('com:police.model.zone')->id($site)->getRow();
    $singleColumn = $extension == 'police' OR $extension == 'files' ? 'true' : 'false';

    $press = object('com:pages.model.page')->id('101')->getRow();
?>

<div id="wrap">
    <div class="container container__header">
        <div class="organization" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/<?= $site ?>">
                <img class="organization__logo" width="160" height="42" itemprop="logo" alt="<?= translate('Police') ?> logo" src="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.jpg" />
                <div class="organization__name"><?= escape($zone->title); ?></div>
            </a>
        </div>

        <div class="navigation">
            <span class="slogan">
                <?= JText::sprintf('Call for urgent police assistance', '101', '101') ?>.
                <?= JText::sprintf('No emergency, just police', escape(str_replace(' ', '', $zone->phone_emergency)), escape($zone->phone_emergency)) ?>.
            </span>
            <div class="navbar">
                <div class="navbar__handlebar">
                    <a class="navbar__logo" href="/<?= $site ?>">
                        <img class="navbar__avatar" width="37" height="37" alt="<?= translate('Police') ?> logo" src="assets://application/images/avatar.png" />
                        <?= translate('Police') ?>
                        <?= escape($zone->title); ?>
                    </a>
                    <a id="button" class="navbar__handle lines-button x" href="#" onclick="Apollo.toggleClass(document.getElementById('navigation'), 'is-shown');Apollo.toggleClass(document.getElementById('button'), 'close')">MENU <span class="lines"></span></a>

                </div>
                <div id="navigation">
                    <ktml:modules position="navigation">
                        <ktml:modules:content>
                    </ktml:modules>
                </div>
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

    <div class="container container__content<?= $extension == 'police' ? ' homepage' : '' ?>">
        <ktml:modules position="left">
            <aside class="sidebar">
                <ktml:modules:content>
            </aside>
        </ktml:modules>

        <? if(!$singleColumn) : ?>
        <div class="component">
        <? endif ?>
            <ktml:content>
        <? if(!$singleColumn) : ?>
        </div>
        <? endif ?>
    </div>

    <div class="container container__footer">
        <div class="row">
            <? if($extension !== 'police') : ?>
            <div class="footer__news">
                <h3><?= translate('Latest news') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <? if($site != '5888') : ?>
            <div class="footer__districts">
                <h3><?= translate('Your district officer') ?></h3>
                <p><?= translate('You know the responsible district officer in your area? He or she is your first contact with the police.') ?></p>
                <a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>"><?= translate('Contact your district officer') ?>.</a>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <? if($site != '5888') : ?>
            <ktml:modules position="quicklinks">
                <div class="container__quicklinks">
                    <ktml:modules:content>
                </div>
            </ktml:modules>
            <? endif ?>
        </div>
    </div>
    <div class="container container__footer_menu">
        <ul class="nav nav--list">
            <li><a href="/<?= $site ?>"><?= translate('Home') ?></a></li>
            <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('News')) ?>"><?= translate('News') ?></a></li>
            <? if($site != '5888') : ?>
            <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Questions')) ?>"><?= translate('Questions') ?></a></li>
            <? endif ?>
            <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Traffic')) ?>"><?= translate('Traffic') ?></a></li>
            <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('About us')) ?>"><?= translate('About us') ?></a></li>
            <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Contact')) ?>"><?= translate('Contact') ?></a></li>
        </ul>
    </div>
</div>

<div id="copyright">
    <div class="container container__copyright">
        <div class="copyright--left">
            <? if($zone->twitter) : ?>
                <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a>&nbsp;&nbsp;|&nbsp;
            <? endif ?>
            <? if($zone->facebook) : ?>
                <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a>&nbsp;&nbsp;|&nbsp;
            <? endif ?>
            <a href="/<?= $site ?>/downloads">Downloads</a>
            <? if($press->published) : ?>
                &nbsp;|&nbsp;&nbsp;<a href="/<?= $site ?>/<?= $press->slug ?>"><?= $press->title ?></a>
            <? endif ?>
        </div>
        <div class="copyright--right">
            © <?= date(array('format' => 'Y')) ?> <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
            <a href="http://www.belgium.be">Belgium.be</a>
        </div>
    </div>
</div>