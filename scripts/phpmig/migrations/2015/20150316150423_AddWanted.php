<?php

use MyPhpmig\Police\Migration;

class AddWanted extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<END

ALTER TABLE `wanted` ADD `published_on` DATETIME  NULL  AFTER `published`;
ALTER TABLE `wanted` ADD `publish_on` DATETIME  NULL  AFTER `locked_on`;
ALTER TABLE `wanted` ADD `case_id` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `date`;

INSERT INTO `files_containers` (`files_container_id`, `slug`, `title`, `path`, `parameters`)
VALUES
	(3, 'attachments-wanted', 'Wanted attachments', 'attachments', '{\"thumbnails\": false,\"maximum_image_size\":\"1024\",\"maximum_size\":\"10485760\",\"thumbnail_size\":\"0.8\",\"allowed_extensions\": [\"bmp\", \"csv\", \"doc\", \"gif\", \"ico\", \"jpg\", \"jpeg\", \"odg\", \"odp\", \"ods\", \"odt\", \"pdf\", \"png\", \"ppt\", \"sql\", \"swf\", \"txt\", \"xcf\", \"xls\"],\"allowed_mimetypes\": [\"image/jpeg\", \"image/gif\", \"image/png\", \"image/bmp\", \"application/x-shockwave-flash\", \"application/msword\", \"application/excel\", \"application/pdf\", \"application/powerpoint\", \"text/plain\", \"application/x-zip\"]}');

END;
        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = <<<END

ALTER TABLE `wanted` DROP `published_on`, DROP `publish_on`, DROP `case_id`;

DELETE FROM `files_containers` WHERE `files_container_id` IN ('3');

END;
        parent::down();
    }
}
