<?php
require_once '_bootstrap.php';

$client = new SoapClient('http://crab.agiv.be/wscrab/WsCrab.svc?wsdl');

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

$updated = 0;
foreach ($cities as $city)
{
    $crab_city = $crab_cities->find(array('NISGemeenteCode' => $city->id, 'TaalCode' => $city->language))->top();

    if (!$crab_city->GemeenteId)
    {
        trigger_error($city->title . ' not found in CRAB database! (#' . $city->id . ')');
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

        $updated++;
    }
}

echo "Updated $updated cities." . PHP_EOL;


