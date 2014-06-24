<?php

use MyPhpmig\Police\Migration;

class Quicklinks extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklink__item_1', 'quicklinks__item');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklink__item_2', 'quicklinks__item');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklink__item_3', 'quicklinks__item');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklink__item_4', 'quicklinks__item last');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklinks__item', 'quicklink__item_1');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklinks__item', 'quicklink__item_2');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklinks__item', 'quicklink__item_3');";
        $this->_queries .= "UPDATE `pages_modules` set `params` = replace(`params`, 'quicklinks__item last', 'quicklink__item_4');";

        parent::down();
    }
}
