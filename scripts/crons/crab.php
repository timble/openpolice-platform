<?php
require_once '_bootstrap.php';

require_once JPATH_ROOT.'/config/config.php';
$config = new \JConfig();

$options = array();
if ($proxy = $config->http_proxy)
{
    $url = $manager->getObject('lib:http.url', array('url' => $proxy));

    $options['proxy_host'] = $url->getHost();
    $options['proxy_port'] = $url->getPort();
}

$client = new SoapClient('http://crab.agiv.be/wscrab/WsCrab.svc?wsdl', $options);

echo "Synchronizing streets database with CRAB database:".PHP_EOL.PHP_EOL;

// For every region, request the list of all cities
$crab_cities = $manager->getObject('com:streets.database.rowset.soap');
foreach (array(1, 2, 3) as $region)
{
    $requestParams = array(
        'SorteerVeld' => 0,
        'GewestId'    => $region
    );

    $results = $client->ListGemeentenByGewestId($requestParams);

    $crab_cities->addRow((array) $results->ListGemeentenByGewestIdResult->GemeenteItem);
}

$query  = $manager->getObject('lib:database.query.select');
$cities = $manager->getObject('com:streets.database.table.cities')->select($query);

$statistics = (object) array('cities' => (object) array('updated' => 0), 'streets' => (object) array('updated' => 0, 'added' => 0, 'deleted' => 0));

foreach ($cities as $city)
{
    $crab_city = $crab_cities->find(array('NISGemeenteCode' => $city->id, 'TaalCode' => $city->language))->top();

    if (!$crab_city->GemeenteId)
    {
        echo "Warning: " . $city->title . ' not found in CRAB database! (#' . $city->id . ')';
        continue;
    }

    if ($city->crab_city_id != $crab_city->GemeenteId || $city->title != $crab_city->GemeenteNaam)
    {
        $old = array('crab_city_id' => $city->crab_city_id, 'title' => $city->title);

        $city->setData(array(
                'crab_city_id' => $crab_city->GemeenteId,
                'title'        => $crab_city->GemeenteNaam
            ))
            ->save();

        $manager->getObject('com:streets.database.table.logs')->getRow(array(
            'data' => array(
                'type'      => 'city',
                'row'       => $city->id,
                'action'    => 'edit',
                'name'      => $city->title,
                'fields'    => array('old' => $old, 'new' => array('crab_city_id' => $city->crab_city_id, 'title' => $city->title))
            )
        ))->save();

        $statistics->cities->updated++;
    }

    // Start synchronizing the streets
    $requestParams = array(
        'SorteerVeld'   => 0,
        'GemeenteId'    => $city->crab_city_id
    );

    $results      = $client->ListStraatnamenByGemeenteId($requestParams);
    $crab_streets = $manager->getObject('com:streets.database.rowset.soap', array('data' => (array) $results->ListStraatnamenByGemeenteIdResult->StraatnaamItem));

    $table   = $manager->getObject('com:streets.database.table.streets');
    $query  = $manager->getObject('lib:database.query.select')
                ->where('tbl.streets_city_id = :city')
                ->bind(array('city' => $city->id));
    $streets = $table->select($query);

    // Loop over all the remote streets and check if anything has been added or changed.
    foreach ($crab_streets as $crab_street)
    {
        $street = $streets->find(array('id' => $crab_street->StraatnaamId))->top();

        if (is_null($street))
        {
            $data = array(
                'id'                => $crab_street->StraatnaamId,
                'title'             => $crab_street->StraatnaamLabel,
                'language'          => $crab_street->TaalCode,
                'title2'            => $crab_street->StraatnaamTweedeTaal,
                'language2'         => $crab_street->TaalCodeTweedeTaal,
                'streets_city_id'   => $city->id,
                'created_on'        => gmdate('Y-m-d H:i:s')
            );

            $street = $table->getRow(array('data' => $data));
            $street->save();

            $manager->getObject('com:streets.database.table.logs')->getRow(array(
                'data' => array(
                    'type'      => 'street',
                    'row'       => $street->id,
                    'action'    => 'add',
                    'name'      => $street->title,
                    'fields'    => array('old' => array(), 'new' => $data)
                )
            ))->save();

            $statistics->streets->added++;
        }
        else
        {
            $comparisons = array(
                'title'     => 'StraatnaamLabel',
                'language'  => 'TaalCode',
                'title2'     => 'StraatnaamTweedeTaal',
                'language2'  => 'TaalCodeTweedeTaal'
            );

            $old = array();
            $new = array();

            foreach ($comparisons as $target => $source)
            {
                $value = $crab_street->get($source);

                if ($street->get($target) != $value)
                {
                    $old[$target] = $street->get($target);
                    $new[$target] = $value;

                    $street->set($target, $value);
                }
            }

            if (count($new))
            {
                $street->modified_on = gmdate('Y-m-d H:i:s');
                $street->save();

                $manager->getObject('com:streets.database.table.logs')->getRow(array(
                    'data' => array(
                        'type'      => 'street',
                        'row'       => $street->id,
                        'action'    => 'edit',
                        'name'      => $street->title,
                        'fields'    => array('old' => $old, 'new' => $new)
                    )
                ))->save();

                $statistics->streets->updated++;
            }
        }
    }

    // Finally, check if we have streets in our database that should be removed
    foreach ($streets as $street)
    {
        $crab_street = $crab_streets->find(array('StraatnaamId' => $street->id))->top();

        if (is_null($crab_street))
        {
            $data = $street->toArray();

            $street->delete();

            $manager->getObject('com:streets.database.table.logs')->getRow(array(
                'data' => array(
                    'type'      => 'street',
                    'row'       => $street->id,
                    'action'    => 'delete',
                    'name'      => $street->title,
                    'fields'    => array('old' => $data, 'new' => array())
                )
            ))->save();

            $statistics->streets->deleted++;
        }
    }
}

echo "Updated " . $statistics->cities->updated . " cities." . PHP_EOL.PHP_EOL;
echo "Added " . $statistics->streets->added . " streets." . PHP_EOL;
echo "Updated " . $statistics->streets->updated . " streets." . PHP_EOL;
echo "Deleted " . $statistics->streets->deleted . " streets." . PHP_EOL;


