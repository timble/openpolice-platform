<?php

use MyPhpmig\Police\Migration;

class AddSearchViewToQuestions extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (108, 1, 0, 'Zoeken', 'zoeken', 'option=com_questions&view=questions&layout=search', NULL, 'component', 1, 1, 0, 40, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";
        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (36, 108, 1),
                                (108, 108, 0);
                            ";
        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (108, 00000000001, 00000000001);
                            ";

        $this->_queries .= "UPDATE `pages` SET `link_url` = 'option=com_questions&view=categories' WHERE `pages_page_id` = '36';";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Recherche', `slug` = 'recherche' WHERE `pages_page_id` = '108';";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "INSERT INTO `fr-fr_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (108, 1, 0, 'Recherche', 'recherche', 'option=com_questions&view=questions&layout=search', NULL, 'component', 1, 1, 0, 40, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";

        $this->_queries .= "UPDATE `fr-fr_pages` SET `link_url` = 'option=com_questions&view=categories' WHERE `pages_page_id` = '36';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DELETE FROM `pages` WHERE `pages_page_id` IN ('108');";

        $this->_queries .= "UPDATE `pages` SET `link_url` = 'option=com_questions&view=questions' WHERE `pages_page_id` = '36';";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-fr_pages` WHERE `pages_page_id` IN ('108');";

        $this->_queries .= "UPDATE `fr-fr_pages` SET `link_url` = 'option=com_questions&view=questions' WHERE `pages_page_id` = '36';";

        parent::down();
    }
}
