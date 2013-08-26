<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? $zone = object('com:police.model.zone')->id($site)->getRow() ?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">
<head>
    <link rel="stylesheet" href="media://application/stylesheets/default.css" type="text/css" />
    <script src="media://application/js/exception.js" />
    <title><?= translate('Error').': '.$code; ?></title>
</head>
<body>

<div id="wrap" class="container-fluid">
    <div class="container-header">
        <div class="row-fluid">
            <div class="span3 alpha">
                <div class="logo" itemscope itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="/<?= $site ?>">
                        <img itemprop="logo" src="media://application/images/logo-nl.jpg" />
                        <span><?= escape($zone->title); ?></span>
                    </a>
                </div>
            </div>
            <div class="span9">
                <span class="slogan">Bel <a class="text--strong" href="tel:101">101</a> voor dringende politiehulp. Geen spoed, wél politie? Bel <a class="text--strong" href="tel:<?= escape($zone->telephone); ?>"><?= escape($zone->telephone); ?></a></span>
            </div>
        </div>
    </div>

    <div class="container-content">
        <div class="row-fluid">
            <div class="span12 alpha component">
                <h1>
                    Page not found
                </h1>
                <div id="errorboxbody">
                    <p><strong><?= translate('You may not be able to visit this page because of:'); ?></strong></p>
                    <ol>
                        <li><?= translate('An out-of-date bookmark/favourite'); ?></li>
                        <li><?= translate('A search engine that has an out-of-date listing for this site'); ?></li>
                        <li><?= translate('A mis-typed address'); ?></li>
                        <li><?= translate('You have no access to this page'); ?></li>
                        <li><?= translate('The requested resource was not found'); ?></li>
                        <li><?= translate('An error has occurred while processing your request.'); ?></li>
                    </ol>
                    <p><strong><?= translate('Please try one of the following pages:'); ?></strong></p>
                    <p>
                    <ul>
                        <li><a href="/" title="<?= translate('Go to the home page'); ?>"><?= translate('Home Page'); ?></a></li>
                    </ul>
                    </p>
                    <p><?= translate('If difficulties persist, please contact the system administrator of this site.'); ?></p>
                    <button id="more-less-button" onclick="toggleHelpBox()" jsdisplay="more" jsvalues=".moreText:more; .lessText:less;" jscontent="more" jstcache="4">More</button>
                    <div id="backtrace" class="is-hidden1">
                        <p><?= $message ?></p>
                        <p>
                            <? if(count($trace)) : ?>
                                <?= include('default_backtrace.html'); ?>
                            <? endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>