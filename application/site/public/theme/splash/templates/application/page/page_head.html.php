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
    <title><?= @escape(@object('application')->getCfg('sitename' )) ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <ktml:meta />
    <ktml:link />
    <ktml:style />
    <ktml:script />

    <link href="media://application/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <style src="media://application/stylesheets/system.css"  />
    <style src="media://application/stylesheets/general.css"  />
    <style src="media://application/stylesheets/default.css" />
    <style src="media://application/stylesheets/print.css" media="print" />

    <script src="media://districts/jquery/jquery.js" />
    <script type="text/javascript">
    var $jQuery = jQuery.noConflict();
    </script>
    <style src="media://districts/select2/select2.css" />
    <script src="media://districts/select2/select2.min.js" />
</head>