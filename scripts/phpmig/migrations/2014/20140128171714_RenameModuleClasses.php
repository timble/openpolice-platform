<?php
use MyPhpmig\Police\Migration;

class RenameModuleClasses extends Migration
{
    public function up()
    {
        $this->_queries = "UPDATE `pages_modules` SET `params` = 'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"0\"\nend_level=\"1\"\nshow_children=\"never\"\nclass=\"\"\ncache=\"1\"' WHERE `pages_module_id` = '1';";
        $this->_queries .= "UPDATE `pages_modules` SET `params` = 'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"2\"\nend_level=\"0\"\nshow_children=\"active\"\nclass=\"nav nav--list\"\ncache=\"0\"' WHERE `pages_module_id` = '2';";

        parent::up();
    }

    public function down()
    {
        $this->_queries = "UPDATE `pages_modules` SET `params` = 'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"0\"\nend_level=\"1\"\nshow_children=\"never\"\nclass=\"nav\"\ncache=\"1\"' WHERE `pages_module_id` = '1';";
        $this->_queries .= "UPDATE `pages_modules` SET `params` = 'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"2\"\nend_level=\"0\"\nshow_children=\"active\"\nclass=\"nav nav-tabs nav-stacked\"\ncache=\"0\"' WHERE `pages_module_id` = '2';";

        parent::down();
    }
}
