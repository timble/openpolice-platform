<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$site = object('application')->getCfg('site');
$zone = object('com:police.model.zone')->id($site)->getRow();

switch ($active->slug) {
    case "nl":
        echo import('privacy_nl.html', array('zone' => $zone));;
        break;
    case 'fr':
        echo import('privacy_fr.html', array('zone' => $zone));;
        break;
    default:
        echo import('privacy_nl.html', array('zone' => $zone));;
        break;
}
?>

