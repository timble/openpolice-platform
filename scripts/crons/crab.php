<?php
require_once '_bootstrap.php';

$client = new SoapClient('http://crab.agiv.be/wscrab/WsCrab.svc?wsdl');

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
        $city->setData(array(
                'crab_city_id' => $crab_city->GemeenteId,
                'title'        => $crab_city->GemeenteNaam
            ))
            ->save();
    }
}
