<?php

use MyPhpmig\Police\Migration;

class AddStatistics extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<EOL

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
	(50, 'Statistics', 'com_statistics', '', 1);

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(119, 1, 0, 'Statistieken', 'statistieken', 'option=com_statistics&view=cities', NULL, 'component', 0, 1, 0, 50, 1, '2015-03-25 17:13:31', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');


INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(119, 119, 0);

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(119, 00000000002, 00000000013);

EOL;

        parent::up();

        // All multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = <<<END

        INSERT INTO `fr-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(119, 1, 0, 'Statistiques', 'statistiques', 'option=com_statistics&view=cities', NULL, 'component', 0, 1, 0, 50, 1, '2015-03-25 17:13:31', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'fr-be', 'pages', 119, 'statistiques', 3, 0, 0),
	(0, 'nl-be', 'pages', 119, 'statistieken', 1, 1, 0);

END;

        parent::up();

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('50');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('119');";

        parent::down();

        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('119');";

        parent::down();
    }
}
