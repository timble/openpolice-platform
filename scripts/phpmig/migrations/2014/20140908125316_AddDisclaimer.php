<?php

use MyPhpmig\Police\Migration;

class AddDisclaimer extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (106, 1, 0, 'Disclaimer', 'disclaimer', 'option=com_police&view=page&layout=disclaimer', NULL, 'component', 1, 1, 0, 41, 1, '2014-09-08 10:05:14', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (107, 1, 0, 'Privacy', 'privacy', 'option=com_police&view=page&layout=privacy', NULL, 'component', 1, 1, 0, 41, 1, '2014-09-08 10:05:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (106, 106, 0),
                                (107, 107, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (106, 00000000002, 00000000010),
                                (107, 00000000008, 00000000011);
                            ";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DELETE FROM `pages` WHERE `pages_page_id` IN ('106', '107');";

        parent::up();
    }
}
