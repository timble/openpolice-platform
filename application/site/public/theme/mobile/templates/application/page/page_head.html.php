<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<head>
    <base href="<?= url(); ?>" />
    <title><?= title() ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="apple-touch-icon" href="assets://application/images/apple-touch-icon.png"/>

    <ktml:title>
    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="assets://application/css/default.css" />
    <style src="assets://application/css/ie.css" condition="if !(lte IE 7)&!(gte IE 8)" />
    <style src="assets://application/css/ie7.css" condition="if lte IE 8" />

    <script src="assets://application/js/html5shiv.js" condition="if lte IE 8" />
    <script src="assets://application/js/jquery.placeholder.js" condition="if lte IE 9" />

    <script src="assets://districts/jquery/jquery.js" />
    <script type="text/javascript">
    var $jQuery = jQuery.noConflict();

    $jQuery(function() {
        $jQuery.stayInWebApp();
    });
    </script>

    <script src="assets://application/js/ie7.js"condition="if lte IE 7" />

    <script src="assets://application/js/navbar.js" />
    <script src="assets://application/js/webapp.js" />
</head>