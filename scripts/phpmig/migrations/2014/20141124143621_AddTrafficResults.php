<?php

use MyPhpmig\Police\Migration;

class AddTrafficResults extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (110, 1, 0, 'Controles', 'controles', 'option=com_traffic&view=articles&category=19', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (111, 1, 0, 'Evenementen', 'evenementen', 'option=com_traffic&view=articles&category=21', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (112, 1, 0, 'Maatregelen', 'maatregelen', 'option=com_traffic&view=articles&category=22', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (113, 1, 0, 'Wegenwerken', 'wegenwerken', 'option=com_traffic&view=articles&category=20', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (114, 1, 0, 'Resultaten', 'resultaten', 'option=com_traffic&view=articles&category=19&layout=results&results=true', NULL, 'component', 1, 1, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (39, 110, 1),
                                (110, 110, 0),
                                (39, 111, 1),
                                (111, 111, 0),
                                (39, 112, 1),
                                (112, 112, 0),
                                (39, 113, 1),
                                (113, 113, 0),
                                (39, 114, 2),
                                (110, 114, 1),
                                (114, 114, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (110, 00000000001, 00000000001),
                                (111, 00000000002, 00000000002),
                                (112, 00000000003, 00000000003),
                                (113, 00000000004, 00000000004),
                                (114, 00000000001, 00000000001);
                            ";

        $this->_queries .= "INSERT INTO `pages_modules_pages` (`pages_module_id`, `pages_page_id`)
                            VALUES
                                (2, 110),
                                (2, 111),
                                (2, 112),
                                (2, 113),
                                (2, 114);
                            ";

        $this->_queries .= "UPDATE `traffic_categories` SET `title` = 'Controles', `slug` = 'controles' WHERE `traffic_category_id` = '19' AND `title`= 'Aangekondigde controles';";
        $this->_queries .= "UPDATE `pages`, `traffic_categories` SET `pages`.`published` = `traffic_categories`.`published` WHERE `pages`.`slug` = `traffic_categories`.`slug`;";

        $this->_queries .= "ALTER TABLE `traffic` ADD `controlled` INT  NULL  DEFAULT NULL  AFTER `end_on`;";
        $this->_queries .= "ALTER TABLE `traffic` ADD `in_violation` INT  NULL  DEFAULT NULL  AFTER `controlled`;";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Contrôles', `slug` = 'controles' WHERE `pages_page_id` = '110';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Événements', `slug` = 'evenements' WHERE `pages_page_id` = '111';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Mesures', `slug` = 'mesures' WHERE `pages_page_id` = '112';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Travaux routiers', `slug` = 'travaux-routiers' WHERE `pages_page_id` = '113';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Résultats', `slug` = 'resultats' WHERE `pages_page_id` = '114';";

        $this->_queries .= "UPDATE `pages`, `traffic_categories` SET `pages`.`published` = `traffic_categories`.`published` WHERE `pages`.`slug` = `traffic_categories`.`slug`;";

        parent::up();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "INSERT INTO `fr-fr_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (110, 1, 0, 'Contrôles', 'controles', 'option=com_traffic&view=articles&category=19', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (111, 1, 0, 'Événements', 'evenements', 'option=com_traffic&view=articles&category=21', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (112, 1, 0, 'Mesures', 'mesures', 'option=com_traffic&view=articles&category=22', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (113, 1, 0, 'Travaux routiers', 'travaux-routiers', 'option=com_traffic&view=articles&category=20', NULL, 'component', 1, 0, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (114, 1, 0, 'Résultats', 'resultats', 'option=com_traffic&view=articles&category=19&layout=results&results=true', NULL, 'component', 1, 1, 0, 37, 1, now(), NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');";

        $this->_queries .= "UPDATE `fr-fr_pages`, `traffic_categories` SET `fr-fr_pages`.`published` = `traffic_categories`.`published` WHERE `pages`.`slug` = `traffic_categories`.`slug`;";

        $this->_queries .= "ALTER TABLE `fr-fr_traffic` ADD `controlled` INT  NULL  DEFAULT NULL  AFTER `end_on`;";
        $this->_queries .= "ALTER TABLE `fr-fr_traffic` ADD `in_violation` INT  NULL  DEFAULT NULL  AFTER `controlled`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DELETE FROM `pages` WHERE `pages_page_id` IN ('110', '111', '112', '113', '114');";

        $this->_queries .= "ALTER TABLE `traffic` DROP `controlled`;";
        $this->_queries .= "ALTER TABLE `traffic` DROP `in_violation`;";

        parent::down();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-fr_pages` WHERE `pages_page_id` IN ('110', '111', '112', '113', '114');";

        $this->_queries .= "ALTER TABLE `fr-fr_traffic` DROP `controlled`;";
        $this->_queries .= "ALTER TABLE `fr-fr_traffic` DROP `in_violation`;";

        parent::down();
    }
}
