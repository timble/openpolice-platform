<?php

use MyPhpmig\Police\Migration;

class NewSubdomains extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "<<<EOL

UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `press` set `text` = replace(`text`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `press` set `text` = replace(`text`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `press` set `text` = replace(`text`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `support_tickets` set `description` = replace(`text`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `support_tickets` set `description` = replace(`text`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `support_tickets` set `description` = replace(`text`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://p.pol-nl.be/', 'http://new.lokalepolitie.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://p.pol-fr.be/', 'http://new.policelocale.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://p.pol-de.be/', 'http://new.lokalepolizei.be/');

EOL;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "<<<EOL

UPDATE `about` set `introtext` = replace(`introtext`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `about_categories` set `description` = replace(`description`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `contacts` set `misc` = replace(`misc`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `contacts_categories` set `description` = replace(`description`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `news` set `introtext` = replace(`introtext`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `press` set `text` = replace(`text`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `press` set `text` = replace(`text`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `press` set `text` = replace(`text`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `questions` set `text` = replace(`text`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `questions` set `text` = replace(`text`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `questions` set `text` = replace(`text`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `questions_categories` set `description` = replace(`description`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `support_tickets` set `description` = replace(`text`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `support_tickets` set `description` = replace(`text`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `support_tickets` set `description` = replace(`text`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

UPDATE `traffic` set `text` = replace(`text`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `traffic` set `text` = replace(`text`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `traffic` set `text` = replace(`text`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://new.lokalepolitie.be/', 'http://p.pol-nl.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://new.policelocale.be/', 'http://p.pol-fr.be/');
UPDATE `traffic_categories` set `description` = replace(`description`, 'http://new.lokalepolizei.be/', 'http://p.pol-de.be/');

EOL;";

        parent::down();
    }
}
