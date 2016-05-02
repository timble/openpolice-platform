<?php
use MyPhpmig\Police\Migration;

class SocialLinks extends Migration
{
    public function up()
    {
        $langCodes  = array(1 => 'nl', 2 => 'fr', 3 => array('nl', 'fr'), 4 => 'de');
        $container  = $this->getContainer();
        $adapter    = $container['db'];

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `police_zones` ADD `social` TEXT  NULL  AFTER `facebook`;
EOL;

        $zones = $adapter->query('SELECT * FROM `police_zones`', \PDO::FETCH_OBJ);
        while ($zone = $zones->fetch())
        {
            $social    = new \stdClass;
            $languages = (array) (array_key_exists($zone->language, $langCodes) ? $langCodes[$zone->language] : $langCodes[1]);

            foreach (array('facebook', 'twitter') as $medium)
            {
                if (!empty($zone->{$medium}))
                {
                    $social->{$medium} = new \stdClass;

                    foreach ($languages as $language) {
                        $social->{$medium}->{$language} = $zone->{$medium};
                    }
                }
            }

            $this->_queries .= "UPDATE `police_zones` SET `social` = '" . json_encode($social) . "' WHERE `police_zone_id` = '" . $zone->police_zone_id . "';" . PHP_EOL;
        }

        $this->_queries .= <<<EOL
ALTER TABLE `police_zones` DROP `facebook`, DROP `twitter`;
EOL;

        parent::up();
    }

    public function down()
    {
        $container  = $this->getContainer();
        $adapter    = $container['db'];

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `police_zones` ADD `twitter` varchar(250) NULL  AFTER `social`;
ALTER TABLE `police_zones` ADD `facebook` varchar(250) NULL  AFTER `twitter`;
EOL;

        $zones = $adapter->query('SELECT * FROM `police_zones`', \PDO::FETCH_OBJ);
        while ($zone = $zones->fetch())
        {
            $social = json_decode($zone->social, true);

            foreach (array('facebook', 'twitter') as $medium)
            {
                if (isset($social[$medium]) && count($social[$medium]))
                {
                    $account = array_shift($social[$medium]);
                    $this->_queries .= "UPDATE `police_zones` SET `" . $medium . "` = '" . $account . "' WHERE `police_zone_id` = '" . $zone->police_zone_id . "';" . PHP_EOL;
                }
            }
        }

        $this->_queries .= <<<EOL
ALTER TABLE `police_zones` DROP `social`;
EOL;

        parent::down();
    }
}
