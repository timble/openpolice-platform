<?php

use MyPhpmig\Police\Migration;

class AttachmentsRelations extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "";
        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `about_categories` AS `category`
                            SET `attachment`.`table` = 'about_categories'
                            WHERE `attachment`.`row` = `category`.`about_category_id` AND `attachment`.`table` = 'categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `contacts_categories` AS `category`
                            SET `attachment`.`table` = 'contacts_categories'
                            WHERE `attachment`.`row` = `category`.`contact_category_id` AND `attachment`.`table` = 'categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `questions_categories` AS `category`
                            SET `attachment`.`table` = 'questions_categories'
                            WHERE `attachment`.`row` = `category`.`questions_category_id` AND `attachment`.`table` = 'categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `traffic_categories` AS `category`
                            SET `attachment`.`table` = 'traffic_categories'
                            WHERE `attachment`.`row` = `category`.`traffic_category_id` AND `attachment`.`table` = 'categories';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "";
        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `about_categories` AS `category`
                            SET `attachment`.`table` = 'categories'
                            WHERE `attachment`.`row` = `category`.`about_category_id` AND `attachment`.`table` = 'about_categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `contacts_categories` AS `category`
                            SET `attachment`.`table` = 'categories'
                            WHERE `attachment`.`row` = `category`.`contacts_category_id` AND `attachment`.`table` = 'contacts_categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `questions_categories` AS `category`
                            SET `attachment`.`table` = 'categories'
                            WHERE `attachment`.`row` = `category`.`questions_category_id` AND `attachment`.`table` = 'questions_categories';";

        $this->_queries .= "UPDATE `attachments_relations` AS `attachment`, `traffic_categories` AS `category`
                            SET `attachment`.`table` = 'categories'
                            WHERE `attachment`.`row` = `category`.`traffic_category_id` AND `attachment`.`table` = 'traffic_categories';";


        parent::down();
    }
}
