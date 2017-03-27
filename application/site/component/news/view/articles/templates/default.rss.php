<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">

    <channel>
        <title><![CDATA[<?= escape($params->get('page_title')).' - '.translate('police').' '.$zone->title;  ?>]]></title>
        <description><![CDATA[<?= escape($params->get('page_title')).' - '.translate('police').' '.$zone->title;  ?>]]></description>
        <link><?= route(array('format' => 'html')) ?></link>
        <pubDate><?= date ('r') ?></pubDate>
        <lastBuildDate><?= date ('r') ?></lastBuildDate>
        <generator>http://www.openpolice.be</generator>
        <language><?= $this->getObject('application.languages')->getActive()->iso_code; ?></language>

        <dc:rights>Copyright <?= helper('date.format', array('format' => 'Y')) ?></dc:rights>

        <sy:updatePeriod><?= $update_period ?></sy:updatePeriod>
        <sy:updateFrequency><?= $update_frequency ?></sy:updateFrequency>

        <atom:link href="<?= route() ?>" rel="self" type="application/rss+xml"/>

        <? foreach($articles as $article) : ?>
        <item>
            <title><![CDATA[<?= escape($article->title) ?>]]></title>
            <link><?= helper('route.article', array('row' => $article)) ?></link>
            <dc:creator><?= @translate('Police') ?> <?= $zone->title ?></dc:creator>
            <guid isPermaLink="false"><?= helper('route.article', array('row' => $article)) ?></guid>
            <description><![CDATA[
                <?= $article->introtext ?>
                <?= helper('com:police.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '400', 'height' => '300'),
                    'url' => 'absolute'
                )) ?>
                <?= $article->fulltext ?>
            ]]></description>
            <pubDate><?= date ('r', strtotime($article->published_on)) ?></pubDate>
        </item>
        <? endforeach; ?>
    </channel>
</rss>
