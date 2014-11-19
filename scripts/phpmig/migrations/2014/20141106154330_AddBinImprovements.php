<?php

use MyPhpmig\Police\Migration;

class AddBinImprovements extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages` SET `published` = '0' WHERE `pages_page_id` = '105';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Je wijk', `slug` = 'je-wijk' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Je wijk', `slug` = 'je-wijk' WHERE `contacts_category_id` = '24';";

        $this->_queries .= "UPDATE `about` set `introtext` = replace(`introtext`, '/contact/je-wijkinspecteur', '/contact/je-wijk');";
        $this->_queries .= "UPDATE `about` set `fulltext` = replace(`fulltext`, '/contact/je-wijkinspecteur', '/contact/je-wijk');";
        $this->_queries .= "UPDATE `contacts` set `misc` = replace(`misc`, '/contact/je-wijkinspecteur', '/contact/je-wijk');";
        $this->_queries .= "UPDATE `about_categories`, `contacts_categories`, `questions`, `questions_categories` set `description` = replace(`description`, '/contact/je-wijkinspecteur', '/contact/je-wijk');";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `contacts_category_id` = '24';";

        $this->_queries .= "UPDATE `about` set `introtext` = replace(`introtext`, '/contact/votre-agent-de-quartier', '/contact/votre-quartier');";
        $this->_queries .= "UPDATE `about` set `fulltext` = replace(`fulltext`, '/contact/votre-agent-de-quartier', '/contact/votre-quartier');";
        $this->_queries .= "UPDATE `contacts` set `misc` = replace(`misc`, '/contact/votre-agent-de-quartier', '/contact/votre-quartier');";
        $this->_queries .= "UPDATE `about_categories`, `contacts_categories`, `questions`, `questions_categories` set `description` = replace(`description`, '/contact/votre-agent-de-quartier', '/contact/votre-quartier');";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `fr-fr_contacts_categories` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `contacts_category_id` = '24';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages` SET `title` = 'Je wijkinspecteur', `slug` = 'je-wijkinspecteur' WHERE `pages_page_id` = '43';";

        $this->_queries .= "UPDATE `about` set `introtext` = replace(`introtext`, '/contact/je-wijk', '/contact/je-wijkinspecteur');";
        $this->_queries .= "UPDATE `about` set `fulltext` = replace(`fulltext`, '/contact/je-wijk', '/contact/je-wijkinspecteur');";
        $this->_queries .= "UPDATE `contacts` set `misc` = replace(`misc`, '/contact/je-wijk', '/contact/je-wijkinspecteur');";
        $this->_queries .= "UPDATE `about_categories`, `contacts_categories`, `questions`, `questions_categories` set `description` = replace(`description`, '/contact/je-wijk', '/contact/je-wijkinspecteur');";

        parent::down();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `contacts_category_id` = '24';";

        $this->_queries .= "UPDATE `about` set `introtext` = replace(`introtext`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `about` set `fulltext` = replace(`fulltext`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `contacts` set `misc` = replace(`misc`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `about_categories`, `contacts_categories`, `questions`, `questions_categories` set `description` = replace(`description`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `fr-fr_contacts_categories` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `contacts_category_id` = '24';";

        parent::down();
    }
}
