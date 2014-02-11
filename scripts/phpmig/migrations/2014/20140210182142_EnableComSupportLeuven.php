<?php

use MyPhpmig\Police\Migration;

class EnableComSupportLeuven extends Migration
{
    public function init()
    {
        $this->getZones()->set(array('5388' => 'Leuven'));
        return parent::init();
    }

    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `extensions` SET `title` = 'Support', `name` = 'com_support' WHERE `extensions_extension_id` = '42';";
        $this->_queries .= "UPDATE `pages` SET `link_url` = 'option=com_support&view=tickets' WHERE `pages_page_id` = '92';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `extensions` SET `title` = 'Zendesk', `name` = 'com_zendesk' WHERE `extensions_extension_id` = '42';";
        $this->_queries .= "UPDATE `pages` SET `link_url` = 'option=com_zendesk&view=zendesks' WHERE `pages_page_id` = '92';";

        parent::down();
    }
}
