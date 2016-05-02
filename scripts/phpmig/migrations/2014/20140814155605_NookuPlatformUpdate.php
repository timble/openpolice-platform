<?php

use MyPhpmig\Police\Migration;

class NookuPlatformUpdate extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `files_containers` set `parameters` = replace(`parameters`, '\"maximum_size\"', '\"maximum_image_size\":\"1024\",\"maximum_size\"');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `files_containers` set `parameters` = replace(`parameters`, '\"maximum_image_size\":\"1024\",\"maximum_size\"', '\"maximum_size\"');";

        parent::down();
    }
}
