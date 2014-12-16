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
    $language_short = $domains[$host]['language'];
    $domain = $domains[$host]['domain'];
    $lang = $domains[$host]['lang'];
} else {
    $language_short = 'nl';
    $domain = 'www';
    $lang = 'en-GB';
}

$search = array(
    'en' => 'Seach your city',
    'nl' => 'Zoek uw gemeente, stad of postcode',
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

$commission = array(
    'en' => 'Vaste Commissie',
    'nl' => 'Vaste Commissie',
    'fr' => 'Commission Permanente' ,
    'de' => 'Vaste Commissie',
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
        'commission' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl')),
    'nl' => array(
        'federal' => array('name' => 'Federale Politie', 'url' => 'http://www.polfed-fedpol.be/home_nl.php'),
        'wanted' => array('name' => 'Opsporingen', 'url' => 'http://www.polfed-fedpol.be/ops/ops_nl.php'),
        'commission' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl')),
    'fr' => array(
        'federal' => array('name' => 'Police fédérale', 'url' => 'http://www.polfed-fedpol.be/home_fr.php'),
        'wanted' => array('name' => 'Avis de recherche', 'url' => 'http://www.polfed-fedpol.be/ops/ops_fr.php'),
        'commission' => array('name' => 'Commission Permanente', 'url' => 'http://www.policelocale.be/portal/fr')),
    'de' => array(
        'federal' => array('name' => 'Föderale Polizei', 'url' => 'http://www.polfed-fedpol.be/home_de.php'),
        'wanted' => array('name' => 'Forschungsansicht', 'url' => 'http://www.polfed-fedpol.be/ops/ops_de.php'),
        'commission' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl')),
);
?>

<title content="replace"><?= $localpolice[$language_short] ?></title>

<div class="splash">
    <div class="splash__logo"><img src="assets://application/images/logo-<?= $language_short ?>.jpg" /></div>

    <div class="well splash__search">
        <form action="#" method="get" class="-koowa-grid">
            <label for="municipality" class="muted"><?= $search[$language_short] ?>:</label>
            <div class="form__right">
                <button class="button button--primary"><?= $button[$language_short] ?></button>
            </div>
            <div class="form__left">
                <input autofocus type="text" class="bigdrop" id="municipality" value="<?= $state->municipality ? $state->municipality : '' ?>" name="municipality" style="width: 100%">
            </div>
        </form>

        <? if($state->municipality) : ?>
        <div class="municipalities">
            <ul class="nav nav--pills nav--visited column--double">
                <? foreach ($municipalities as $municipality) : ?>
                    <li><a href="?id=<?= $municipality->id ?>"><?= $municipality->title ?></a></li>
                <? endforeach ?>
                <? if(!count($municipalities)) : ?>
                    <?= sprintf($notfound[$language_short], '<strong>'.$state->municipality.'</strong>') ?>
                <? endif ?>
            </ul>
        </div>
        <? endif ?>
    </div>

    <div class="splash__languages">
        <a href="http://<?= $domain ?>.lokalepolitie.be">Nederlands</a>
        <a href="http://<?= $domain ?>.policelocale.be">Français</a>
        <a href="http://<?= $domain ?>.lokalepolizei.be">Deutsch</a>
    </div>
    <div class="splash__external">
        <a href="<?= $external[$language_short]['federal']['url'] ?>"><?= $external[$language_short]['federal']['name'] ?></a>
        <a href="<?= $external[$language_short]['wanted']['url'] ?>"><?= $external[$language_short]['wanted']['name'] ?></a>
        <a href="https://policeonweb.belgium.be">Police On Web</a>
        <a href="https://www.ecops.be/">eCops</a>
        <a href="<?= $external[$language_short]['commission']['url'] ?>"><?= $external[$language_short]['commission']['name'] ?></a>
    </div>
</div>