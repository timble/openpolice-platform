<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>
<?
$zone = object('com:police.model.zone')->id($site)->getRow();
$language_short = explode("-", $language);
$language_short = $language_short[0];
?>

<!DOCTYPE HTML>
<html class="js-disabled" lang="<?= $language; ?>" dir="<?= $direction; ?>">

<?= import('page_head.html') ?>
<body>

<? if($site = 'default') : ?>
    <?= import('default_splash.html') ?>
<? else : ?>
    <?= import('default_site.html', array('zone' => $zone, 'language_short' => $language_short)) ?>
<? endif ?>

</body>
</html>