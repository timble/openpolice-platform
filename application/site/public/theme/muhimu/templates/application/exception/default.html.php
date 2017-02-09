<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?
    $zone = object('com:police.model.zone')->id($site)->getRow();
    $language_short = explode("-", $language);
    $language_short = $language_short[0];
?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">
<head>
    <base href="<?= url(); ?>" />
    <title><?= translate('Page not found') ?> - <?= $code; ?></title>

    <ktml:title>
    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="assets://application/css/default.css" />
    <style src="assets://application/css/ie.css" condition="if IE 8" />
    <style src="assets://application/css/ie7.css" condition="if lte IE 7" />

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
<div id="wrapper">
    <div class="skip">
        <div class="container__skip">
            <a href="#content">Skip to main content</a>
        </div>
    </div>
    <div class="container__top">
        <div class="organization" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/<?= $site ?>">
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

    <div class="container__breadcrumb">
        <ul class="breadcrumb">
            <li><a href="/<?= $site ?>" class="pathway">Home</a></li>
        </ul>
    </div>

    <div id="content" class="container container__content">
        <div class="component component--no-sidebar">
            <article class="article">
                <h1 class="article__header"><?= translate('Page not found') ?></h1>

                <div class="exception">
                    <div class="exception__message component">
                        <p><strong><?= translate('You may not be able to visit this page because of'); ?>:</strong></p>
                        <ul>
                            <li><?= translate('An out-of-date bookmark/favourite'); ?></li>
                            <li><?= translate('A search engine that has an out-of-date listing for this site'); ?></li>
                            <li><?= translate('A mis-typed address'); ?></li>
                            <li><?= translate('The requested resource was not found'); ?></li>
                            <li><?= translate('An error has occurred while processing your request'); ?></li>
                        </ul>
                    </div>
                </div>

                <p style="margin-top: 30px; clear: both">
                    <a class="button button--primary" href="/<?= $site ?>" title="<?= translate('Go to the homepage'); ?>"><?= translate('Go to the homepage'); ?></a>
                </p>

                <? if(count($trace)) : ?>
                <div class="backtrace">
                    <button id="backtrace__button" class="button--link" onclick="toggleBacktrace()" data-text-less="<?= translate('Less') ?>" data-text-more="<?= translate('More') ?>"><?= translate('More') ?></button>
                </div>
                <div id="backtrace__info" class="is-hidden">
                    <?= import('default_backtrace.html'); ?>
                </div>
                <? endif; ?>
            </article>
        </div>
    </div>
</div>

</body>

</html>
