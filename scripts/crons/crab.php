<?php
require_once '_bootstrap.php';

$client = new SoapClient('http://crab.agiv.be/wscrab/WsCrab.svc?wsdl');

$regions = array(1, 2, 3);

$query  = $manager->getObject('lib:database.query.select');
$cities = $manager->getObject('com:streets.database.table.cities')->select($query);

// For every region, request the list of all cities
foreach ($regions as $region)
{
    $requestParams = array(
        'SorteerVeld' => 0,
        'GewestId'    => $region
    );

    $results = $client->ListGemeentenByGewestId($requestParams);

    foreach ($results->ListGemeentenByGewestIdResult->GemeenteItem as $result)
    {
        $city = $cities->find(array('id' => $result->NISGemeenteCode))->top();

        if ($city->isNew())
        {
            trigger_error($result->GemeenteNaam . ' does not exist in data.streets_cities! (NIS: ' . $result->NISGemeenteCode . ')');
            continue;
        }

        if (!$city->crab_city_id) {
            $city->setData(array('crab_city_id' => $result->GemeenteId))->save();
        }
    }
}