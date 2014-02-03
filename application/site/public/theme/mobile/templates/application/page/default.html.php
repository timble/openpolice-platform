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
<html lang="<?= $language; ?>" dir="<?= $direction; ?>" prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#"">

<?= import('page_head.html') ?>
<body id="page" class="no-js">
<script data-inline type="text/javascript" pagespeed_no_defer="">function hasClass(e,t){return e.className.match(new RegExp("(\\s|^)"+t+"(\\s|$)"))}var el=document.getElementById("page");var cl="no-js";if(hasClass(el,cl)){var reg=new RegExp("(\\s|^)"+cl+"(\\s|$)");el.className=el.className.replace(reg,"js-enabled")}</script>

<? if($site == 'default') : ?>
    <?= import('default_splash.html', array('zone' => $zone, 'language_short' => $language_short)) ?>
<? else : ?>
    <?= import('default_site.html', array('zone' => $zone, 'language_short' => $language_short)) ?>
<? endif ?>

</body>
</html>