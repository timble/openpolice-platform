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
    'www.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'www', 'lang' => 'nl-be'),
    'www.policelocale.be'       => array('language' => 'fr', 'domain' => 'www', 'lang' => 'fr-be'),
    'www.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'www', 'lang' => 'de-be'),
    'new.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'new', 'lang' => 'nl-be'),
    'new.policelocale.be'       => array('language' => 'fr', 'domain' => 'new', 'lang' => 'fr-be'),
    'new.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'new', 'lang' => 'de-be'),
    'staging.lokalepolitie.be'  => array('language' => 'nl', 'domain' => 'staging', 'lang' => 'nl-be'),
    'staging.policelocale.be'   => array('language' => 'fr', 'domain' => 'staging', 'lang' => 'fr-be'),
    'staging.lokalepolizei.be'  => array('language' => 'de', 'domain' => 'staging', 'lang' => 'de-be')
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
    'nl' => array('label' => 'Zoek jouw lokale politiezone via je woonplaats of postcode', 'placeholder' => 'Woonplaats of postcode'),
    'fr' => array('label' => 'Trouvez votre zone de police locale en saisissant votre ville ou code postal', 'placeholder' => 'Ville ou code postal'),
    'de' => array('label' => 'Finden Sie Ihren lokalen Polizei durch Ihre Wohnort oder Postleitzahl', 'placeholder' => 'Wohnort oder Postleitzahl'),
);

$button = array(
    'nl' => 'Zoeken',
    'fr' => 'Rechercher',
    'de' => 'Recherche',
);

$notfound = array(
    'nl' => '%s niet gevonden',
    'fr' => '%s pas trouvé',
    'de' => '%s nicht gefunden',
);

$localpolice = array(
    'nl' => 'Lokale Politie',
    'fr' => 'Police Locale' ,
    'de' => 'Lokale Polizei',
);

$streams = array(
    'nl' => array('news' => 'http://'.$host.'/fed/nl/nieuws', 'wanted' => 'http://'.$host.'/fed/nl/opsporingen'),
    'fr' => array('news' => 'http://'.$host.'/fed/nl/nouvelles', 'wanted' => 'http://'.$host.'/fed/nl/avis-de-recherche') ,
    'de' => array('news' => 'http://'.$host.'/fed/nl/nouvelles', 'wanted' => 'http://'.$host.'/fed/fr/avis-de-recherche'),
);

$wanted = array(
    'nl' => array(
        'missing' => array('name' => 'Vermist', 'url' => '/fed/nl/opsporingen/vermist', 'description' => 'Help ons bij het terug vinden van vermiste personen. Hebt u tips?', 'link' => 'Alle vermiste personen'),
        'wanted' => array('name' => 'Gezocht', 'url' => '/fed/nl/opsporingen/gezocht', 'description' => 'Help ons bij de zoeken naar daders of slachtoffers van een misdrijf.', 'link' => 'Alle gezochte personen'),
    ),
    'fr' => array(
        'missing' => array('name' => 'Disparus', 'url' => '/fed/fr/avis-de-recherche/disparus', 'description' => 'Aidez-nous à retrouver des personnes disparues.', 'link' => 'Toutes les personnes disparues'),
        'wanted' => array('name' => 'Recherchés', 'url' => '/fed/fr/avis-de-recherche/recherches', 'description' => 'Aidez-nous à rechercher des auteurs ou victimes de délits.', 'link' => 'Toutes les personnes recherchées'),
    ),
    'de' => array(
        'missing' => array('name' => 'Disparus', 'url' => '/fed/fr/avis-de-recherche/disparus', 'description' => 'Aidez-nous à retrouver des personnes disparues.', 'link' => 'Toutes les personnes disparues'),
        'wanted' => array('name' => 'Recherchés', 'url' => '/fed/fr/avis-de-recherche/recherches', 'description' => 'Aidez-nous à rechercher des auteurs ou victimes de délits.', 'link' => 'Toutes les personnes recherchées'),
    ),
);

$external = array(
    'nl' => array(
        'local' => array('name' => 'Lokale Politie', 'url' => '/zones', 'description' => 'Op lokaal vlak is de politie georganiseerd in 192 politiezones. Uw lokale politiezone is het eerste contact bij de politie.'),
        'federal' => array('name' => 'Federale Politie', 'url' => '/fed/nl', 'description' => 'Op federaal niveau staat één politiekorps, de federale politie, in voor de gespecialiseerde politiezorg en de ondersteunende opdrachten.'),
        'wanted' => array('name' => 'Opsporingen', 'url' => '#wanted', 'description' => 'Help ons bij de zoeken naar vermiste personen en daders of slachtoffers van een misdrijf. Hebt u tips?', 'link' => 'Alle gezochte personen'),
        'help' => array('name' => 'Noodnummers', 'url' => '/fed/nl/contact/noodnummers', 'description' => 'Een noodgeval? Raadpleeg het overzicht van Belgische noodnummers, hulpdiensten en andere nuttige telefoonnummers.'),
        'pow' => array('name' => 'Online aangifte', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Online klacht indienen voor kleine misdrijven, uw alarmsysteem aanmelden en politietoezicht aanvragen voor uw woning tijdens uw vakantie of afwezigheid.'),
    ),
    'fr' => array(
        'local' => array('name' => 'Lokale Politie', 'url' => '/zones', 'description' => 'Le niveau local est organisé par 192 zones de police. Votre zone de police locale est le premier contact avec la police.'),
        'federal' => array('name' => 'Police fédérale', 'url' => '/fed/fr', 'description' => 'Au niveau fédéral, une seule police, la police fédérale, assure la fonction de police spécialisée et des missions d\'appui.'),
        'wanted' => array('name' => 'Avis de recherches', 'url' => '#wanted', 'description' => 'Aidez-nous à retrouver des personnes disparues et des auteurs ou victimes de délits.'),
        'help' => array('name' => 'Numéros d\'urgence', 'url' => '/fed/fr/contact/des-numeros-durgence', 'description' => 'Un cas d\'urgence ? Consultez l\'aperçu des numéros d\'appel d\'urgence, des services de secours et d\'autres numéros de téléphone utiles.'),
        'pow' => array('name' => 'Déclaration en ligne', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Porter plainte en ligne pour des petits délits, déclarer votre système d\'alarme et demander une surveillance policière de votre habitation pendant vos vacances ou en cas d\'absence.'),
    ),
    'de' => array(
        'local' => array('name' => 'Lokale Politie', 'url' => '/zones', 'description' => 'Op lokaal vlak is de politie georganiseerd in 192 politiezones. Je lokale politiezone is je eerste contact met de politie.'),
        'federal' => array('name' => 'Föderale Polizei', 'url' => 'http://www.polfed-fedpol.be/org/org_de.php'),
        'search' => array('name' => 'Forschungsansicht', 'url' => 'http://www.polfed-fedpol.be/ops/ops_de.php'),
        'help' => array('name' => 'Notrufnummern', 'url' => 'http://www.polfed-fedpol.be/hulp_de.php'),
        'pow' => array('name' => 'Online Angabe', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Online Bagatelldelikte Anzeige erstatten, Ihr Alarmsystem melden und während Ihres Urlaubs oder Ihrer Abwesendheid für Ihr Zuhause Polizeiüberwachung beantragen.'),
    ),
);

$footer = array(
    'nl' => array(
        'vclp' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl', 'description' => 'test'),
    ),
    'fr' => array(
        'vclp' => array('name' => 'Commission Permanente', 'url' => 'http://www.policelocale.be/portal/fr'),
    ),
    'de' => array(
        'vclp' => array('name' => 'Kommission', 'url' => 'http://www.lokalepolizei.be/portal/nl'),
    ),
);
?>

<title content="replace"><?= $localpolice[$language] ?></title>
<meta content="<?= $search[$language] ?>." name="description" />

<div class="intro__header">
    <div class="intro__container">
        <img src="assets://application/images/logo-<?= $language ?>.png" />
    </div>
</div>

<div class="intro">
    <div class="intro__search">
        <div class="intro__container">
            <div class="intro__search--inner">
                <form action="#" method="get">
                    <label class="search__label" for="search"><?= $search[$language]['label'] ?>:</label>
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
        </div>
    </div>

    <div class="intro__external">
        <div class="intro__container">
            <? foreach ($external[$language] as $key => $value) : ?>
                <div class="external__item">
                    <h3><a href="<?= $external[$language][$key]['url'] ?>"><?= $external[$language][$key]['name'] ?></a></h3>
                    <p><?= $external[$language][$key]['description'] ?></p>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <div class="intro__news">
        <div class="intro__container">
            <?
            $json = file_get_contents($streams[$language]['news'].'.json?limit=3');
            $data = json_decode($json);
            ?>

            <? foreach ($data->items as $data) : ?>
                <? $article = $data->data; ?>
                <div class="intro__news__item card">
                    <a href="<?= $streams[$language]['news'].'/'.$article->id.'-'.$article->slug ?>">
                        <? if($article->thumbnail): ?>
                            <img width="400px" height="300px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                        <? endif ?>
                        <span class="card__metadata"><?= $article->title ?></span>
                    </a>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <meta content="noimageindex" name="robots" />

    <div id="wanted" class="intro__wanted container">
        <div class="intro__container">
            <? $columns = array('missing' => array('section' => '1', 'name' => 'missing'), 'wanted' => array('section' => '2', 'name' => 'wanted')) ?>
            <? foreach($columns as $column) : ?>
                <div class="intro__wanted--<?= $column['name'] ?>">
                    <h2><?= $wanted[$language][$column['name']]['name'] ?></h2>
                    <ul class="cards clearfix">
                        <?
                        $json = file_get_contents($streams[$language]['wanted'].'.json?view=articles&limit=4&section='.$column['section']);
                        $data = json_decode($json);
                        ?>
                        <? foreach ($data->items as $data) : ?>
                            <? $article = $data->data; ?>
                            <li class="card card--horizontal">
                                <a href="<?= $streams[$language]['wanted'].'/'.$article->section_slug.'/'.$article->category_slug ?>">
                                    <? if($article->thumbnail): ?>
                                        <img height="500px" width="400px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                                    <? else : ?>
                                        <img src="assets://found/images/placeholder.jpg" />
                                    <? endif ?>

                                    <span class="card__metadata">
                                    <span class="card__metadata--inner">
                                        <span class="card__name"><?= escape($article->title) ?></span>
                                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => 'd/m/Y')) ?>
                                            <? $params = json_decode($article->params); ?>
                                            <? if(isset($params->place) || $article->city) : ?>
                                                <span class="card__place"><?= $article->city ? $article->city : $params->place ?></span>
                                            <? endif ?>
                                    </span>
                                </span>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <p><?= $wanted[$language][$column['name']]['description'] ?></p>
                    <a href="<?= $wanted[$language][$column['name']]['url'] ?>"><?= $wanted[$language][$column['name']]['link'] ?> &rarr;</a>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <div class="intro__languages">
        <div class="intro__container">
            <ul class="nav nav--pills nav--visited nav--horizontal">
                <li><a href="http://<?= $domain ?>.lokalepolitie.be">Nederlands</a></li>
                <li><a href="http://<?= $domain ?>.policelocale.be">Français</a></li>
                <li><a href="http://<?= $domain ?>.lokalepolizei.be">Deutsch</a></li>
            </ul>
        </div>
    </div>

    <div class="intro__footer">

    </div>
</div>