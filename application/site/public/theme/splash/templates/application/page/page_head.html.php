<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<head>
    <base href="<?= url(); ?>" />
    <title><?= escape(object('application')->getCfg('sitename' )) ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="assets://application/stylesheets/system.css"  />
    <style src="assets://application/stylesheets/general.css"  />
    <style src="assets://application/stylesheets/default.css" />
    <style src="assets://application/stylesheets/print.css" media="print" />

    <script src="assets://application/js/jquery.js" />
    <script type="text/javascript">
    var $jQuery = jQuery.noConflict();
    </script>
    <style src="assets://application/components/select2/select2.css" />
    <script src="assets://application/components/select2/select2.min.js" />
</head>