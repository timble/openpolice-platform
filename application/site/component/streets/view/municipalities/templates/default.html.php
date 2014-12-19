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
$domains = array(
    'www.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'www', 'lang' => 'nl-NL'),
    'www.policelocale.be'       => array('language' => 'fr', 'domain' => 'www', 'lang' => 'fr-FR'),
    'www.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'www', 'lang' => 'de-DE'),
    'new.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'new', 'lang' => 'nl-NL'),
    'new.policelocale.be'       => array('language' => 'fr', 'domain' => 'new', 'lang' => 'fr-FR'),
    'new.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'new', 'lang' => 'de-DE'),
    'staging.lokalepolitie.be'  => array('language' => 'nl', 'domain' => 'staging', 'lang' => 'nl-NL'),
    'staging.policelocale.be'   => array('language' => 'fr', 'domain' => 'staging', 'lang' => 'fr-FR'),
    'staging.lokalepolizei.be'  => array('language' => 'de', 'domain' => 'staging', 'lang' => 'de-DE')
);

$url    = $this->getObject('application')->getRequest()->getUrl();
$host   = $url->getHost();

// Make sure the given host exists
if(array_key_exists($host, $domains))
{
    $language = $domains[$host]['language'];
    $domain = $domains[$host]['domain'];
} else {
    $language = 'nl';
    $domain = 'www';
}

$search = array(
    'en' => 'Seach your city',
    'nl' => 'Zoek jouw lokale politiezone via je woonplaats of postcode',
    'fr' => 'Chercher votre ville',
    'de' => 'Suchen Sie Ihre Stadt',
);

$button = array(
    'en' => 'Search',
    'nl' => 'Zoeken',
    'fr' => 'Rechercher',
    'de' => 'Recherche',
);

$notfound = array(
    'en' => '%s not found',
    'nl' => '%s niet gevonden',
    'fr' => '%s niet gevonden',
    'de' => '%s niet gevonden',
);

$localpolice = array(
    'en' => 'Local Police',
    'nl' => 'Lokale Politie',
    'fr' => 'Police Locale' ,
    'de' => 'Lokale Polizei',
);


$external = array(
    'en' => array(
        'federal' => array('name' => 'Federal Police', 'url' => 'http://www.polfed-fedpol.be/org/org_en.php'),
        'wanted' => array('name' => 'Wanted', 'url' => 'http://www.polfed-fedpol.be/ops/ops_en.php'),
        'help' => array('name' => 'Emergency numbers', 'url' => 'http://www.polfed-fedpol.be/hulp_en.php')),
    'nl' => array(
        'federal' => array('name' => 'Federale Politie', 'url' => 'http://www.polfed-fedpol.be/home_nl.php'),
        'wanted' => array('name' => 'Opsporingen', 'url' => 'http://www.polfed-fedpol.be/ops/ops_nl.php'),
        'help' => array('name' => 'Noodnummers', 'url' => 'http://www.polfed-fedpol.be/hulp_nl.php')),
    'fr' => array(
        'federal' => array('name' => 'Police fédérale', 'url' => 'http://www.polfed-fedpol.be/home_fr.php'),
        'wanted' => array('name' => 'Avis de recherche', 'url' => 'http://www.polfed-fedpol.be/ops/ops_fr.php'),
        'commission' => array('name' => 'Numéros d\'urgence', 'url' => 'http://www.polfed-fedpol.be/hulp_fr.php')),
    'de' => array(
        'federal' => array('name' => 'Föderale Polizei', 'url' => 'http://www.polfed-fedpol.be/home_de.php'),
        'wanted' => array('name' => 'Forschungsansicht', 'url' => 'http://www.polfed-fedpol.be/ops/ops_de.php'),
        'help' => array('name' => 'Notrufnummern', 'url' => 'http://www.polfed-fedpol.be/hulp_de.php')),
);
?>

<title content="replace"><?= $localpolice[$language] ?></title>

<div class="splash">
    <div class="splash__logo"><img src="assets://application/images/logo-<?= $language ?>.jpg" /></div>

    <div class="well splash__search">
        <form action="#" method="get">
            <label for="municipality" class="muted"><?= $search[$language] ?>:</label>
            <div class="search">
                <div class="search__field">
                    <input autofocus type="text" value="<?= $state->search ? $state->search : '' ?>" name="search" onfocus="this.value = this.value;">
                </div>
                <button class="button button--primary"><?= $button[$language] ?></button>
            </div>
        </form>

        <? if($state->search) : ?>
        <div class="municipalities">
            <ul class="nav nav--pills nav--visited column--double">
                <? foreach ($municipalities as $municipality) : ?>
                    <li><a href="?municipality=<?= $municipality->streets_municipality_id.'&language='.$municipality->language ?>"><?= $municipality->title ?></a></li>
                <? endforeach ?>
                <? if(!count($municipalities)) : ?>
                    <?= sprintf($notfound[$language], '<strong>'.$state->search.'</strong>') ?>
                <? endif ?>
            </ul>
        </div>
        <? endif ?>
    </div>

    <div class="splash__languages">
        <ul class="nav nav--pills nav--visited nav--horizontal">
            <li><a href="http://<?= $domain ?>.lokalepolitie.be/default">Nederlands</a></li>
            <li><a href="http://<?= $domain ?>.policelocale.be/default">Français</a></li>
            <li><a href="http://<?= $domain ?>.lokalepolizei.be/default">Deutsch</a></li>
        </ul>
    </div>

    <div class="splash__external">
        <ul class="nav nav--pills nav--visited nav--horizontal">
            <li><a href="<?= $external[$language]['help']['url'] ?>"><?= $external[$language]['help']['name'] ?></a></li>
            <li><a href="<?= $external[$language]['wanted']['url'] ?>"><?= $external[$language]['wanted']['name'] ?></a></li>
            <li><a href="https://policeonweb.belgium.be">Police On Web</a></li>
            <li><a href="https://www.ecops.be/">eCops</a></li>
            <li><a href="<?= $external[$language]['federal']['url'] ?>"><?= $external[$language]['federal']['name'] ?></a></li>
        </ul>
    </div>
</div>