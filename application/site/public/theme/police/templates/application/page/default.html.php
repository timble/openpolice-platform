<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<!DOCTYPE HTML>
<html lang="<?= $language; ?>" dir="<?= $direction; ?>">

<? $component = @helper('module.count', array('condition' => 'right')) ? '6' : '9' ?>

<?= @template('page_head.html') ?>
<body>
<div id="container" class="container">

    <ktml:modules position="user3">
	<div id="top" class="clearfix">
	    <ktml:modules:content />
	</div>
    </ktml:modules>

	<div id="header" class="site5388">
		<div class="row">
			<div class="span4">
                <ktml:modules position="telephone">
                <div class="contact">
                    <ktml:modules:content />
				</div>
                </ktml:modules>
				<div id="sitename">
					<a href="#"><?= @helper('com:police.string.title', array('site' => @object('application')->getCfg('site'))); ?></a>
				</div>
			</div>
			<ktml:modules position="user4_">
				<div class="span3 pull-right">
					<ktml:modules:content />
				</div>
            </ktml:modules>
		</div>
	</div>

	<ktml:modules position="navigation">
	<div id="navigation">
		<div class="navbar">
			<div class="navbar-inner">
				<ktml:modules:content />
			</div>
		</div>
	</div>
	</ktml:modules>

	<div id="main">
	    <div class="row">
	        <div id="left" class="span3">
	        	<div id="left-inner">
	        		<ktml:modules position="left" chrome="wrapped" />
	        	</div>
                <ktml:modules position="top" chrome="wrapped" />
	        </div>
	        <div id="maincol" class="span9">
	            <ktml:modules position="breadcrumbs">
	            	<div id="breadcrumbs">
		            	<ktml:modules:content />
	            	</div>
	            </ktml:modules>
	            <div class="row">
		            <div id="component" class="span<?= $component ?>">
		            	<div id="component-inner" style="<?= $component == '9' ? 'padding-right: 20px;' : '' ?>">
			            	<ktml:content />
			            </div>
		            </div>
		            <ktml:modules position="right" chrome="wrapped">
		            	<div id="right" class="span3">
		            		<div id="right-inner">
		            			<ktml:modules:content />
		            		</div>
		            	</div>
		            </ktml:modules>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<div id="footer" class="container">
	<div class="module mod_syndicate">
		<a href="/5388/home.feed?type=rss">RSS</a>
	</div>

	<ul>
		<li>Copyright - Lokale Politie - Leuven 2013©</li>
		<li><a target="_blank" href="http://www.lokalepolitie.be/portal/nl/disclaimer.html">Disclaimer</a></li>
		<li><a target="_blank" href="http://www.lokalepolitie.be/portal/nl/privacy.html">Privacy</a></li>
		<li><a target="_blank" href="http://www.belgium.be"><img src="/theme/police/images/icon_belgium.gif" border="0"></a></li>
	</ul>
</div>

</body>
</html>