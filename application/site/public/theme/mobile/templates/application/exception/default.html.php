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
    <title><?= translate('Error').': '.$code; ?></title>

    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

        <style src="assets://application/css/default.css" />

    <script>
        function toggleBacktrace() {
            var helpBoxOuter = document.getElementById('backtrace__info');
            helpBoxOuter.classList.toggle('is-hidden');
            var moreLessButton = document.getElementById('backtrace__button');
            if (helpBoxOuter.classList.contains('is-hidden')) {
                moreLessButton.innerText = moreLessButton.getAttribute('data-text-more');
            } else {
                moreLessButton.innerText = moreLessButton.getAttribute('data-text-less');
            }
        }
    </script>
</head>

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
            </div>
        </div>
    </div>

    <div class="container-content">
        <h1><?= translate('Page not found') ?> - <?= $code ?></h1>
        <div class="row-fluid">
            <div class="span7 alpha component">
                <p><strong><?= translate('You may not be able to visit this page because of:'); ?></strong></p>
                <ol>
                    <li><?= translate('An out-of-date bookmark/favourite'); ?></li>
                    <li><?= translate('A search engine that has an out-of-date listing for this site'); ?></li>
                    <li><?= translate('A mis-typed address'); ?></li>
                    <li><?= translate('The requested resource was not found'); ?></li>
                    <li><?= translate('An error has occurred while processing your request.'); ?></li>
                </ol>
                <p><strong><?= translate('Please try one of the following pages:'); ?></strong></p>
                <ul>
                    <li><a href="/" title="<?= translate('Go to the home page'); ?>"><?= translate('Home Page'); ?></a></li>
                </ul>
            </div>
            <div class="span5">
                <img class="thumbnail" src="assets://application/images/error.jpg" />
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="backtrace">
                    <button id="backtrace__button" class="btn" onclick="toggleBacktrace()" data-text-less="<?= translate('Less') ?>" data-text-more="<?= translate('More') ?>">More</button>
                </div>
                <div id="backtrace__info" class="is-hidden">
                    <? if(count($trace)) : ?>
                        <?= import('default_backtrace.html'); ?>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>