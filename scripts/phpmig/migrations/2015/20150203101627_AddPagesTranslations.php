<?php

use MyPhpmig\Police\Migration;

class AddPagesTranslations extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = <<<END

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
    (0, 'nl-be', 'pages', 106, 'disclaimer', 1, 1, 0),
	(0, 'fr-be', 'pages', 106, 'disclaimer', 3, 0, 0),
	(0, 'nl-be', 'pages', 107, 'privacy', 1, 1, 0),
	(0, 'fr-be', 'pages', 107, 'privacy', 3, 0, 0),
	(0, 'nl-be', 'pages', 108, 'zoeken', 1, 1, 0),
	(0, 'fr-be', 'pages', 108, 'recherche', 3, 0, 0),
	(0, 'nl-be', 'pages', 109, 'analytics', 1, 1, 0),
	(0, 'fr-be', 'pages', 109, 'analytics', 3, 0, 0),
    (0, 'nl-be', 'pages', 110, 'controles', 1, 1, 0),
	(0, 'fr-be', 'pages', 110, 'controles', 3, 0, 0),
	(0, 'nl-be', 'pages', 111, 'evenementen', 1, 1, 0),
	(0, 'fr-be', 'pages', 111, 'evenements', 3, 0, 0),
	(0, 'nl-be', 'pages', 112, 'maatregelen', 1, 1, 0),
	(0, 'fr-be', 'pages', 112, 'mesures', 3, 0, 0),
	(0, 'nl-be', 'pages', 113, 'wegenwerken', 1, 1, 0),
	(0, 'fr-be', 'pages', 113, 'travaux-routiers', 3, 0, 0),
	(0, 'nl-be', 'pages', 114, 'resultaten', 1, 1, 0),
	(0, 'fr-be', 'pages', 114, 'resultats', 3, 0, 0);

	DELETE FROM `languages_translations` WHERE `row`= '105' AND `table` = 'pages';

END;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "SELECT 1;";

        parent::down();
    }
}
