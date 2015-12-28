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
    <base href="<?= escape(url()); ?>" />
    <title><?= $code; ?> - <?= translate('Page not found') ?></title>

    <ktml:title>
    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="assets://application/css/default.css" />
    <style src="assets://application/css/grid.css" />
    <style src="assets://application/css/ie.css" condition="if lte IE 8" />
    <style src="assets://application/css/ie9.css" condition="if lte IE 9" />

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
<div id="wrap">
    <div class="container container__header">
        <div class="header">
            <div class="organization" itemscope itemtype="http://schema.org/Organization">
                <a itemprop="url" href="/<?= $site ?>">
                    <div class="organization__logo organization__logo--<?= $language_short; ?> organization__logo--<?= $site; ?>"></div>
                    <div class="organization__name"><?= escape($zone->title); ?></div>
                </a>
            </div>
            <div class="navigation">
                <span class="slogan">
                    <?= JText::sprintf('Call for urgent police assistance', '101', '101') ?>.
                    <? if($zone->phone_information || $zone->phone_emergency) : ?>
                        <?= JText::sprintf('No emergency, just police', $zone->phone_information ? escape($zone->phone_information) : escape($zone->phone_emergency)) ?>.
                    <? endif ?>
                </span>
            </div>
        </div>
    </div>

    <div class="container container__content">
        <h1><?= translate('Page not found') ?> - <?= $code ?></h1>

        <div class="exception clearfix">
            <div class="exception__message component">
                <p><strong><?= translate('You may not be able to visit this page because of'); ?>:</strong></p>
                <ul>
                    <li><?= translate('An out-of-date bookmark/favourite'); ?></li>
                    <li><?= translate('A search engine that has an out-of-date listing for this site'); ?></li>
                    <li><?= translate('A mis-typed address'); ?></li>
                    <li><?= translate('The requested resource was not found'); ?></li>
                    <li><?= translate('An error has occurred while processing your request'); ?></li>
                </ul>
                <p><strong><?= translate('Please try one of the following pages'); ?>:</strong></p>
                <ul>
                    <li><a href="/<?= $site ?>" title="<?= translate('Home Page'); ?>"><?= translate('Home Page'); ?></a></li>
                    <li><a href="/<?= $site ?>/contact" title="<?= translate('Contact'); ?>"><?= translate('Contact'); ?></a></li>
                </ul>
            </div>
            <div class="exception__image">
                <img class="thumbnail" src="assets://application/images/error.jpg" />
            </div>
        </div>

        <div class="text-center" style="margin-top: 30px; clear: both">
            <a class="button button--primary button--large" href="/<?= $site ?>" title="<?= translate('Home Page'); ?>"><?= translate('Home Page'); ?></a>
        </div>

        <? if(count($trace)) : ?>
        <div class="backtrace">
            <button id="backtrace__button" class="button--link" onclick="toggleBacktrace()" data-text-less="<?= translate('Less') ?>" data-text-more="<?= translate('More') ?>"><?= translate('More') ?></button>
        </div>
        <div id="backtrace__info" class="is-hidden">
            <?= import('default_backtrace.html'); ?>
        </div>
        <? endif; ?>
    </div>
</div>

</body>

</html>