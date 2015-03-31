<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsViewMunicipalitiesHtml extends ArticlesViewHtml
{
    public function render()
    {
        $this->_assignStrings();
        $this->_setDomain();

        if ($this->getLayout() == 'intro')
        {
            $this->_fetchStreams();
        }

        return parent::render();
    }

    protected function _setDomain()
    {
        $domains = array(
            'www.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'www', 'lang' => 'nl-be'),
            'www.policelocale.be'       => array('language' => 'fr', 'domain' => 'www', 'lang' => 'fr-be'),
            'www.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'www', 'lang' => 'de-be'),
            'new.lokalepolitie.be'      => array('language' => 'nl', 'domain' => 'new', 'lang' => 'nl-be'),
            'new.policelocale.be'       => array('language' => 'fr', 'domain' => 'new', 'lang' => 'fr-be'),
            'new.lokalepolizei.be'      => array('language' => 'de', 'domain' => 'new', 'lang' => 'de-be'),
            'staging.lokalepolitie.be'  => array('language' => 'nl', 'domain' => 'staging', 'lang' => 'nl-be'),
            'staging.policelocale.be'   => array('language' => 'fr', 'domain' => 'staging', 'lang' => 'fr-be'),
            'staging.lokalepolizei.be'  => array('language' => 'de', 'domain' => 'staging', 'lang' => 'de-be'),
            'www.politie.be'            => array('language' => 'nl', 'domain' => 'www', 'lang' => 'nl-be'),
            'www.police.be'             => array('language' => 'fr', 'domain' => 'www', 'lang' => 'fr-be'),
            'www.polizei.be'            => array('language' => 'de', 'domain' => 'www', 'lang' => 'de-be'),
            'new.politie.be'            => array('language' => 'nl', 'domain' => 'new', 'lang' => 'nl-be'),
            'new.police.be'             => array('language' => 'fr', 'domain' => 'new', 'lang' => 'fr-be'),
            'new.polizei.be'            => array('language' => 'de', 'domain' => 'new', 'lang' => 'de-be'),
            'staging.politie.be'        => array('language' => 'nl', 'domain' => 'staging', 'lang' => 'nl-be'),
            'staging.police.be'         => array('language' => 'fr', 'domain' => 'staging', 'lang' => 'fr-be'),
            'staging.polizei.be'        => array('language' => 'de', 'domain' => 'staging', 'lang' => 'de-be')
        );

        $url  = $this->getObject('application')->getRequest()->getUrl();
        $host = $url->getHost();

        if (array_key_exists($host, $domains))
        {
            $this->language = $domains[$host]['language'];
            $this->domain   = $domains[$host]['domain'];
        }
        else
        {
            $this->language = 'nl';
            $this->domain   = 'www';
        }
    }

    protected function _fetchStreams()
    {
        $url  = $this->getObject('application')->getRequest()->getUrl();
        $host = $url->getHost();

        $this->streams = array(
            'nl' => array('news' => 'http://'.$host.'/fed/nl/nieuws', 'wanted' => 'http://'.$host.'/fed/nl/opsporingen'),
            'fr' => array('news' => 'http://'.$host.'/fed/fr/nouvelles', 'wanted' => 'http://'.$host.'/fed/fr/avis-de-recherche') ,
            'de' => array('news' => 'http://'.$host.'/fed/fr/nouvelles', 'wanted' => 'http://'.$host.'/fed/fr/avis-de-recherche'),
        );

        // Fetch the news first
        $url = $this->streams[$this->language]['news'] . '.json?limit=3';
        $this->newsitems = $this->getObject('com:streets.model.streams')
                        ->url($url)
                        ->getItems();

        // Now fetch the different wanted sections
        $this->sections = array('missing' => array('section' => '1', 'name' => 'missing'), 'wanted' => array('section' => '2', 'name' => 'wanted'));
        $wanteditems    = array();

        foreach ($this->sections as $section => $config)
        {
            $url = $this->streams[$this->language]['wanted'] . '.json?view=articles&limit=4&section='.$config['section'];

            $wanteditems[$section] = $this->getObject('com:streets.model.streams')
                                        ->url($url)
                                        ->getItems();
        }

        $this->wanteditems = $wanteditems;
    }

    protected function _assignStrings()
    {
        $this->intro = array(
            'nl' => array('title' => 'Belgische politie', 'description' => 'Portaal van de Belgische politie'),
            'fr' => array('title' => 'Police belge', 'description' => 'Portail de la Police belge'),
            'de' => array('title' => 'Belgischen Polizei', 'description' => 'Portal der belgischen Polizei'),
        );

        $this->search = array(
            'nl' => array('label' => 'Zoek jouw lokale politiezone via je woonplaats of postcode', 'placeholder' => 'Woonplaats of postcode'),
            'fr' => array('label' => 'Trouvez votre zone de police locale en saisissant votre ville ou code postal', 'placeholder' => 'Ville ou code postal'),
            'de' => array('label' => 'Finden Sie Ihren lokalen Polizei durch Ihre Wohnort oder Postleitzahl', 'placeholder' => 'Wohnort oder Postleitzahl'),
        );

        $this->button = array(
            'nl' => 'Zoeken',
            'fr' => 'Rechercher',
            'de' => 'Recherche',
        );

        $this->notfound = array(
            'nl' => '%s niet gevonden',
            'fr' => '%s pas trouvé',
            'de' => '%s nicht gefunden',
        );

        $this->localpolice = array(
            'nl' => 'Lokale Politie',
            'fr' => 'Police Locale' ,
            'de' => 'Lokale Polizei',
        );

        $this->wanted = array(
            'nl' => array(
                'missing' => array('name' => 'Vermist', 'url' => '/fed/nl/opsporingen/vermist', 'description' => 'Help ons bij het terug vinden van vermiste personen. Hebt u tips?', 'link' => 'Alle vermiste personen'),
                'wanted' => array('name' => 'Gezocht', 'url' => '/fed/nl/opsporingen/gezocht', 'description' => 'Help ons bij de zoeken naar daders of slachtoffers van een misdrijf.', 'link' => 'Alle gezochte personen'),
            ),
            'fr' => array(
                'missing' => array('name' => 'Disparus', 'url' => '/fed/fr/avis-de-recherche/disparus', 'description' => 'Aidez-nous à retrouver des personnes disparues.', 'link' => 'Toutes les personnes disparues'),
                'wanted' => array('name' => 'Recherchés', 'url' => '/fed/fr/avis-de-recherche/recherches', 'description' => 'Aidez-nous à rechercher des auteurs ou victimes de délits.', 'link' => 'Toutes les personnes recherchées'),
            ),
            'de' => array(
                'missing' => array('name' => 'Disparus', 'url' => '/fed/de/avis-de-recherche/disparus', 'description' => 'Aidez-nous à retrouver des personnes disparues.', 'link' => 'Toutes les personnes disparues'),
                'wanted' => array('name' => 'Recherchés', 'url' => '/fed/de/avis-de-recherche/recherches', 'description' => 'Aidez-nous à rechercher des auteurs ou victimes de délits.', 'link' => 'Toutes les personnes recherchées'),
            ),
        );

        $this->external = array(
            'nl' => array(
                'federal' => array('name' => 'Federale Politie', 'url' => '/fed/nl', 'description' => 'Op federaal niveau staat één politiekorps, de federale politie, in voor de gespecialiseerde politiezorg en de ondersteunende opdrachten.'),
                'local' => array('name' => 'Lokale Politie', 'url' => 'http://www.lokalepolitie.be/zones', 'description' => 'Op lokaal vlak is de politie georganiseerd in 192 politiezones. Uw lokale politiezone is het eerste contact bij de politie.'),
                'help' => array('name' => 'Noodnummers', 'url' => '/fed/nl/contact/noodnummers', 'description' => 'Een noodgeval? Raadpleeg het overzicht van Belgische noodnummers, hulpdiensten en andere nuttige telefoonnummers.'),
                'wanted' => array('name' => 'Opsporingen', 'url' => '#wanted', 'description' => 'Help ons bij de zoeken naar vermiste personen en daders of slachtoffers van een misdrijf. Hebt u tips?', 'link' => 'Alle gezochte personen'),
                'pow' => array('name' => 'Online aangifte', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Online klacht indienen voor kleine misdrijven, uw alarmsysteem aanmelden en politietoezicht aanvragen voor uw woning tijdens uw vakantie of afwezigheid.'),
            ),
            'fr' => array(
                'federal' => array('name' => 'Police fédérale', 'url' => '/fed/fr', 'description' => 'Au niveau fédéral, une seule police, la police fédérale, assure la fonction de police spécialisée et des missions d\'appui.'),
                'local' => array('name' => 'Lokale Politie', 'url' => 'http://www.policelocale.be/zones', 'description' => 'Le niveau local est organisé par 192 zones de police. Votre zone de police locale est le premier contact avec la police.'),
                'help' => array('name' => 'Numéros d\'urgence', 'url' => '/fed/fr/contact/des-numeros-durgence', 'description' => 'Un cas d\'urgence ? Consultez l\'aperçu des numéros d\'appel d\'urgence, des services de secours et d\'autres numéros de téléphone utiles.'),
                'wanted' => array('name' => 'Avis de recherches', 'url' => '#wanted', 'description' => 'Aidez-nous à retrouver des personnes disparues et des auteurs ou victimes de délits.'),
                'pow' => array('name' => 'Déclaration en ligne', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Porter plainte en ligne pour des petits délits, déclarer votre système d\'alarme et demander une surveillance policière de votre habitation pendant vos vacances ou en cas d\'absence.'),
            ),
            'de' => array(
                'federal' => array('name' => 'Föderale Polizei', 'url' => '/fed/de', 'description' => 'Auf der föderalen Ebene beschäftigt sich ein Polizeikorps, die föderale Polizei, mit der spezialisierten Polizeiarbeit und den Unterstützungsaufträgen.'),
                'local' => array('name' => 'Lokale Politie', 'url' => 'http://www.lokalepolizei.be/zones', 'description' => 'Auf lokaler Ebene ist die Polizei in 192 Polizeizonen aufgeteilt. Ihre lokale Polizei ist der erste Kontakt mit der Polizei.'),
                'help' => array('name' => 'Notrufnummern', 'url' => '/fed/de/kontakt/notrufnummern', 'description' => 'Un cas d\'urgence ? Consultez l\'aperçu des numéros d\'appel d\'urgence, des services de secours et d\'autres numéros de téléphone utiles.'),
                'wanted' => array('name' => 'Forschungsansicht', 'url' => '#wanted', 'description' => 'Aidez-nous à retrouver des personnes disparues et des auteurs ou victimes de délits.'),
                'pow' => array('name' => 'Online Angabe', 'url' => 'https://policeonweb.belgium.be', 'description' => 'Online Bagatelldelikte Anzeige erstatten, Ihr Alarmsystem melden und während Ihres Urlaubs oder Ihrer Abwesendheid für Ihr Zuhause Polizeiüberwachung beantragen.'),
            ),
        );

        $this->footer = array(
            'nl' => array(
                'vclp' => array('name' => 'Vaste Commissie', 'url' => 'http://www.lokalepolitie.be/portal/nl', 'description' => 'test'),
            ),
            'fr' => array(
                'vclp' => array('name' => 'Commission Permanente', 'url' => 'http://www.policelocale.be/portal/fr'),
            ),
            'de' => array(
                'vclp' => array('name' => 'Kommission', 'url' => 'http://www.lokalepolizei.be/portal/fr'),
            ),
        );
    }
}