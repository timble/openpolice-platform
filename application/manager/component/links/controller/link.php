<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class LinksControllerLink extends Library\ControllerModel
{
    protected function _actionBootup(Library\CommandContext $context)
    {
        $zones = $this->getObject('com:police.model.zones')
            ->platform('2')
            ->id('5388')
            ->getRowset();

//        $domains = ['www.police.be', 'www.politie.be', 'www.polizei.be', 'www.lokalepolitie.be', 'www.policelocale.be', 'www.lokalepolizei.be'];
        $domains = ['police.dev'];

        foreach($zones as $zone)
        {
            foreach($domains as $domain)
            {
                $url = 'http://'.$domain.'/'.$zone->id;

                $link                   = $this->getObject('com:links.database.row.link');
                $link->id               = md5($url);
                $link->status           = $this->getStatus($url);
                $link->last_checked_on  = gmdate('Y-m-d H:i:s');
                $link->url              = $url;
                $link->title            = $this->getTitle($link->url);
                $link->police_zone_id   = $this->getZone($link->url);
                $link->save();
            }
        }
    }

    protected function _actionCrawl(Library\CommandContext $context)
    {
        // Server, give us some time, please
        ini_set('max_execution_time', 0);

        $link = $this->getObject('com:links.model.links')
            ->crawled('0')
            ->status('200')
            ->limit('1')
            ->getRowset()->top();

        $urls = $this->crawler($link->url, '2', false);

        foreach($urls as $url)
        {
            $row        = $this->getObject('com:links.database.row.link');
            $row->id    = md5($url['url']);

            if(!$row->load()) {
                $row->url               = $url['url'];
                $row->police_zone_id    = $this->getZone($url['url']);
            }

            $row->status            = $this->getStatus($url['url']);
            $row->title             = $this->getTitle($url['url']);
            $row->last_checked_on   = gmdate('Y-m-d H:i:s');
            $row->save();

            // Save the links on each page as relations
            $relation = $this->getObject('com:links.database.row.relation');
            $relation->links_link_id    = md5($url['url']);
            $relation->linked_on     = $link->id;

            if(!$relation->load() && ($relation->links_link_id !== $relation->linked_on)) {
                $relation->save();
            }
        }

        $link->last_crawled_on = gmdate('Y-m-d H:i:s');
        $link->crawled = true;
        $link->save();
    }

    public function crawler($url, $depth, $same_host)
    {
        require_once('Crawler.php'); // or wherever autoload.php is located

        try
        {
            $crawler = new Crawler($url, $depth, $same_host);
            return $crawler->crawl();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function getStatus($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        return $httpCode;
    }

    public function getTitle($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);
        curl_close($handle);

        preg_match("/\<title.*\>(.*)\<\/title\>/isU", $response, $matches);

        if(isset($matches[1]))
        {
            return $matches[1];
        }

        return false;
    }

    public function getZone($url)
    {
        preg_match('/\/(5[0-9]{3}|fed)\/?/', $url, $matches);

        if(isset($matches[1]))
        {
            return $matches[1];
        }

        return false;
    }

    public function getTags($url, $tag)
    {
        $tags = get_meta_tags($url);

        return $tags[$tag];
    }
}