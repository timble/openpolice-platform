<?php

use MyPhpmig\Police\Migration;

class RestructurePages extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages_closures` SET `ancestor_id` = '9' WHERE `ancestor_id` = '4' AND `descendant_id` = '57';";
        $this->_queries .= "UPDATE `pages_orderings` SET `custom` = '00000000003' WHERE `pages_page_id` = '57';";
        $this->_queries .= "
            INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
            VALUES
                (99, 2, 1, 'Import', 'import', 'option=com_uploads&view=uploads', NULL, 'component', 1, 0, 0, 44, 1, '2014-04-23 13:50:40', NULL, NULL, NULL, NULL, 0, '');
            ";
        $this->_queries .= "
            INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
            VALUES
                (9, 99, 1),
                (99, 99, 0);
            ";
        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (99, 00000000004, 00000000004);";

        parent::up();

        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'Inhoud' WHERE `pages_page_id` = '4';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Bestanden' WHERE `pages_page_id` = '5';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Logboek' WHERE `pages_page_id` = '10';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Ondersteuning' WHERE `pages_page_id` = '92';";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Contenu' WHERE `pages_page_id` = '4';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Fichiers' WHERE `pages_page_id` = '5';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Outils' WHERE `pages_page_id` = '9';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Registre' WHERE `pages_page_id` = '10';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages_closures` SET `ancestor_id` = '4' WHERE `ancestor_id` = '9' AND `descendant_id` = '57';";
        $this->_queries .= "UPDATE `pages_orderings` SET `custom` = '00000000007' WHERE `pages_page_id` = '57';";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('99');";
        $this->_queries .= "DELETE FROM `pages_orderings` WHERE `pages_page_id` IN ('99');";

        $this->_queries .= "UPDATE `pages` SET `title` = 'Content' WHERE `pages_page_id` = '4';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Files' WHERE `pages_page_id` = '5';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Tools' WHERE `pages_page_id` = '9';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Activity Logs' WHERE `pages_page_id` = '10';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Support' WHERE `pages_page_id` = '92';";

        parent::down();
    }
}
