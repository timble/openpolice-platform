<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<head>
    <base href="<?= escape(url()); ?>" />
    <title><?= title().' - '. translate( 'Administration'); ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta content="chrome=1" http-equiv="X-UA-Compatible" />

    <ktml:title>
    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

    <link href="assets://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <script src="assets://js/mootools.js" />
    <script src="assets://application/js/application.js" />
    <script src="assets://application/js/chromatable.js" />

    <style src="assets://application/stylesheets/default.css" />
    <style src="assets://police/stylesheets/default.css" />

    <script src="assets://application/js/jquery.js" /></script>
    <script type="text/javascript">
    var $jQuery = jQuery.noConflict();
    </script>
    <script src="assets://application/js/select2.js" /></script>

    <?php if($site && $analytics = object('application')->getCfg('analytics')) : ?>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-20242887-3', 'auto');
    ga('send', 'pageview');

    </script>
    <? endif ?>
</head>
