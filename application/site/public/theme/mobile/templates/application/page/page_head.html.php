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
    <base href="<?= @url(); ?>" />
    <title>Politie Leuven</title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta name="viewport" content="width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="apple-touch-icon" href="media://application/images/apple-touch-icon.png"/>

    <ktml:meta />
    <ktml:link />
    <ktml:style />
    <ktml:script />

    <link href="media://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="media://application/stylesheets/default.css" />
    <style src="media://application/stylesheets/ie.css" condition="if lte IE 8" />
    <style src="media://application/stylesheets/ie7.css" condition="if lte IE 7" />

    <!--[if lte IE 8]>
    <script src="media://application/js/html5shiv.js" />
    <![endif]-->

    <script src="media://districts/jquery/jquery.js" />
    <script type="text/javascript">
    var $jQuery = jQuery.noConflict();

    $jQuery(function() {
        $jQuery.stayInWebApp();
    });
    </script>
    <script src="media://application/js/navbar.js" />
    <script src="media://application/js/webapp.js" />
</head>