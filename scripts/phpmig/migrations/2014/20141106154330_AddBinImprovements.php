<?php

use MyPhpmig\Police\Migration;

class AddBinImprovements extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "";

        parent::down();
    }
}
