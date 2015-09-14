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

$external = array(
    'en' => array(
        'federal' => array('name' => 'Federal Police', 'url' => 'http://www.politie.be/fed'),
        'wanted' => array('name' => 'Wanted', 'url' => 'http://www.politie.be/fed/nl/opsporingen'),
        'help' => array('name' => 'Emergency numbers', 'url' => 'http://www.politie.be/fed/nl/contact/noodnummers'),
        'vclp' => array('name' => 'Committee', 'url' => 'http://www.lokalepolitie.be/portal/nl')
    ),
    'nl' => array(
        'federal' => array('name' => 'Federale Politie', 'url' => 'http://www.politie.be/fed/nl'),
        'wanted' => array('name' => 'Opsporingen', 'url' => 'http://www.politie.be/fed/nl/opsporingen'),
        'help' => array('name' => 'Noodnummers', 'url' => 'http://www.politie.be/fed/nl/contact/noodnummers'),
        'vclp' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl')
    ),
    'fr' => array(
        'federal' => array('name' => 'Police fédérale', 'url' => 'http://www.police.be/fed/fr'),
        'wanted' => array('name' => 'Avis de recherche', 'url' => 'http://www.police.be/fed/fr/avis-de-recherche'),
        'help' => array('name' => 'Numéros d\'urgence', 'url' => 'http://www.police.be/fed/fr/contact/numeros-durgence'),
        'vclp' => array('name' => 'Commission Permanente', 'url' => 'http://www.policelocale.be/portal/fr')
    ),
    'de' => array(
        'federal' => array('name' => 'Föderale Polizei', 'url' => 'http://www.polizei.be/fed/de'),
        'wanted' => array('name' => 'Forschungsansicht', 'url' => 'http://www.polizei.be/fed/de/avis-de-recherche'),
        'help' => array('name' => 'Notrufnummern', 'url' => 'http://www.polizei.be/fed/de/kontakt/notrufnummern'),
        'vclp' => array('name' => 'Kommission', 'url' => 'http://www.policelocale.be/portal/fr')
    ),
);
?>

<title content="replace"><?= $localpolice[$language] ?></title>
<meta content="<?= $search[$language]['label'] ?>." name="description" />

<div class="splash">
    <div class="splash__logo"><img src="assets://application/images/logo-<?= $language ?>.jpg" /></div>

    <div class="well splash__search">
        <form action="#" method="get">
            <label for="municipality" class="muted"><?= $search[$language]['label'] ?>:</label>
            <div class="search-box">
                <div class="search-box__input">
                    <input autofocus type="text" value="<?= $state->search ? $state->search : '' ?>" name="search" onfocus="this.value = this.value;" placeholder="<?= $search[$language]['placeholder'] ?>">
                </div>
                <button class="button button--primary search-box__button"><?= $button[$language] ?></button>
            </div>
        </form>

        <? if($state->search) : ?>
        <div class="municipalities">
            <ul class="nav nav--pills nav--visited column--double">
                <? foreach ($municipalities as $municipality) : ?>
                    <li><a href="?municipality=<?= $municipality->streets_municipality_id.'&language='.$municipality->language ?>"><?= $municipality->title ?></a></li>
                <? endforeach ?>
            </ul>
            <? if(!count($municipalities)) : ?>
                <?= sprintf($notfound[$language], '<strong>'.$state->search.'</strong>') ?>
            <? endif ?>
            <?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>
        </div>
        <? endif ?>
    </div>

    <div class="splash__languages">
        <ul class="nav nav--pills nav--visited nav--horizontal">
            <li><a href="http://<?= $domain ?>.lokalepolitie.be/zones">Nederlands</a></li>
            <li><a href="http://<?= $domain ?>.policelocale.be/zones">Français</a></li>
            <li><a href="http://<?= $domain ?>.lokalepolizei.be/zones">Deutsch</a></li>
        </ul>
    </div>

    <div class="splash__external">
        <ul class="nav nav--pills nav--visited nav--horizontal">
            <li><a href="<?= $external[$language]['help']['url'] ?>"><?= $external[$language]['help']['name'] ?></a></li>
            <li><a href="<?= $external[$language]['wanted']['url'] ?>"><?= $external[$language]['wanted']['name'] ?></a></li>
            <li><a href="https://policeonweb.belgium.be">Police On Web</a></li>
            <li><a href="<?= $external[$language]['federal']['url'] ?>"><?= $external[$language]['federal']['name'] ?></a></li>
            <li><a href="<?= $external[$language]['vclp']['url'] ?>"><?= $external[$language]['vclp']['name'] ?></a></li>
        </ul>
    </div>
</div>