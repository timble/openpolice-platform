<?php

use MyPhpmig\Police\Migration;

class AddPoliceToManager extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = "INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
                            VALUES
                                (4, 'Police', 'com_police', '', 1);
                            ";

        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (3, 1, 0, 'Zones', 'zones', 'option=com_police&view=zones', NULL, 'component', 1, 0, 0, 4, 1, now(), NULL, NULL, NULL, NULL, 0, NULL);
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (3, 3, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (3, 00000000003, 00000000003);
                            ";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('4');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('3');";

        parent::down();
    }
}
