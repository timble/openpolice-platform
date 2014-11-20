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
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('105');";
        $this->_queries .= "DELETE FROM `contacts_categories` WHERE `slug` IN ('reseau-information-de-quartier', 'buurt-informatie-netwerk');";

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
        $this->_queries .= "DELETE FROM `fr-fr_pages` WHERE `pages_page_id` IN ('105');";
        $this->_queries .= "DELETE FROM `fr-fr_contacts_categories` WHERE `slug` IN ('reseau-information-de-quartier');";

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
        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (105, 1, 0, 'Buurt Informatie Netwerk', 'buurt-informatie-netwerk', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:48:59', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";
        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (41, 105, 1),
                                (105, 105, 0);
                            ";
        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (105, 00000000004, 00000000005);
                            ";

        parent::down();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Votre quartier', `slug` = 'votre-quartier' WHERE `contacts_category_id` = '24';";

        $this->_queries .= "UPDATE `about` set `introtext` = replace(`introtext`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `about` set `fulltext` = replace(`fulltext`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `contacts` set `misc` = replace(`misc`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `about_categories`, `contacts_categories`, `questions`, `questions_categories` set `description` = replace(`description`, '/contact/votre-quartier', '/contact/votre-agent-de-quartier');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Réseau d\'Information de Quartier', `slug` = 'reseau-information-de-quartier' WHERE `pages_page_id` = '105';";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `pages_page_id` = '43';";
        $this->_queries .= "UPDATE `fr-fr_contacts_categories` SET `title` = 'Votre agent de quartier', `slug` = 'votre-agent-de-quartier' WHERE `contacts_category_id` = '24';";
        $this->_queries .= "UPDATE `fr-fr_pages` SET `title` = 'Réseau d\'Information de Quartier', `slug` = 'reseau-information-de-quartier' WHERE `pages_page_id` = '105';";

        parent::down();
    }
}
