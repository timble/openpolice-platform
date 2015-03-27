<?

// Backup of the code to update the filenames of crime PDFs

$dir = '/var/www/police.dev/sites/fed/files/files/crime/city';
$files = scandir($dir, 1);

foreach ($files as $file) {
    $search = 'rapport_2014_trim2_com_';

    $filename = str_replace($search, "", $file);

    if (strpos($file, $search) !== false) {
        rename($dir . '/' . $file, $dir . '/' . $filename);
    }


    $search = 'rapport_2014_trim2_gem_';

    $filename = str_replace($search, "", $file);

    if (strpos($file, $search) !== false) {
        rename($dir . '/' . $file, $dir . '/' . $filename);
    }
}

$files = scandir($dir, 1);

foreach ($files as $file) {
    if (strpos($file, '_fr.pdf') !== false) {
        $city_in_file = str_replace('_fr.pdf', "", $file);
        $language = 'fr';
    }

    if (strpos($file, '_nl.pdf') !== false) {
        $city_in_file = str_replace('_nl.pdf', "", $file);
        $language = 'nl';
    }

    $city = object('com:streets.model.cities')->title1(str_replace('_', ' ', $city_in_file))->getRowset();

    if (count($city) == 0) {
        $city = object('com:streets.model.cities')->title1(str_replace('_', '-', $city_in_file))->getRowset();
    }

    if (count($city) == 1) {
        $city = $city->top();

        if (strpos($file, $city->id . '_' . $language . '.pdf') == false) {
            rename($dir . '/' . $file, $dir . '/' . $city->id . '_' . $language . '.pdf');
        }
    }
}

foreach ($files as $file) {
    if (strpos($file, '.pdf') !== false) {
        echo $file;
    }
}

foreach ($files as $file) {
    $filename = str_replace("rapport_2014_trim2_zone_", "", $file);
    if (strpos($file, 'rapport_2014_trim2_zone_') !== false) {
        rename($dir . '/' . $file, $dir . '/' . $filename);
    }
}

foreach ($files as $file) {
    if (strpos($file, '.pdf') !== false) {
        echo $file;
    }
}