<?php
use MyPhpmig\Police\Migration;

class AddManagerApplication extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<EOL
INSERT INTO `pages_menus` (`pages_menu_id`, `application`, `title`, `slug`, `description`, `created_by`) VALUES (3, 'manager', 'Menubar', 'menubar', 'Manager site main menu', '1');

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`)
VALUES
	(100, 3, 0, 'Dashboard', 'dashboard', 'option=com_dashboard&view=dashboard', 'component', 1, 0, 0, 35, 1),
	(101, 3, 0, 'Support', 'support', 'option=com_support&view=tickets', 'component', 1, 0, 0, 45, 1);

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(100, 00000000001, 00000000001),
	(101, 00000000002, 00000000002);

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(100, 100, 0),
	(101, 101, 0);
EOL;


        parent::up();

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = <<<EOL
DELETE FROM `pages_menus` WHERE `pages_menu_id` IN ('3');

DELETE FROM `pages` WHERE `pages_page_id` IN (100, 101);
EOL;

        parent::down();
    }
}
