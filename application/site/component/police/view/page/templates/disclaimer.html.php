<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$site = object('application')->getCfg('site');
$zone = object('com:police.model.zone')->id($site)->getRow();

switch ($active->slug) {
    case "nl":
        echo import('disclaimer_nl.html', array('zone' => $zone));;
        break;
    case 'fr':
        echo import('disclaimer_fr.html', array('zone' => $zone));;
        break;
    default:
        echo import('disclaimer_nl.html', array('zone' => $zone));;
        break;
}
?>