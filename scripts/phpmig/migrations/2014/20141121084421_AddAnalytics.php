<?php

use MyPhpmig\Police\Migration;

class AddAnalytics extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
                            VALUES
                                (47, 'Analytics', 'com_analytics', '', 1);
                            ";

        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (109, 2, 0, 'Analytics', 'analytics', 'option=com_analytics&view=analytic', NULL, 'component', 1, 0, 0, 47, 1, '2014-11-21 08:54:36', NULL, NULL, NULL, NULL, 0, '');
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (9, 109, 1),
                                (109, 109, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (109, 00000000001, 00000000006);
                            ";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "INSERT INTO `fr_fr-pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (109, 2, 0, 'Analytics', 'analytics', 'option=com_analytics&view=analytic', NULL, 'component', 1, 0, 0, 47, 1, '2014-11-21 08:54:36', NULL, NULL, NULL, NULL, 0, '');
                            ";

        parent::up();

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "CREATE TABLE `analytics` (
                          `analytics_analytic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                          `token` varchar(250) DEFAULT NULL,
                          `expires_on` int(10) DEFAULT NULL,
                          `created` int(10) DEFAULT NULL,
                          PRIMARY KEY (`analytics_analytic_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->_queries .= "INSERT INTO `analytics` (`analytics_analytic_id`, `token`, `expires_on`, `created`)
                            VALUES
                                (1, '', '', '');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('47');";
        $this->_queries .= "DELETE FROM `pages` WHERE `extensions_extension_id` IN ('109');";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries .= "DELETE FROM `fr_fr-pages` WHERE `extensions_extension_id` IN ('109');";

        parent::down();

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "DROP TABLE `analytics_analytics`;";

        parent::down();
    }
}
