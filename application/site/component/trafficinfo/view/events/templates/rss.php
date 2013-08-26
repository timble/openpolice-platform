<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?='<?xml version="1.0" encoding="utf-8" ?>' ?>

<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">
<channel>
	<title><?= translate('Traffic Info') ?></title>
	<description><?= translate('Traffic Info') ?></description>
	<generator>http://www.nooku.org?v=<?= Koowa::VERSION ?></generator>
	
	<? foreach($events as $event): ?>
	
	<? endforeach; ?>

	<link><?= route() ?></link>
	<atom:link href="<?= route() ?>" rel="self" type="application/rss+xml" />
</channel>
</rss>