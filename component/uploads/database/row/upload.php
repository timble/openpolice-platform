<?php
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Uploads;

use Nooku\Library;
use Sunra\PhpSimple\HtmlDomParser;

class DatabaseRowUpload extends Library\DatabaseRowTable
{
    public function save() {

        $file = $_FILES["file"];
        $source = $file["tmp_name"];

        $allowedExtensions = array("csv");

        $table = $this->table;

        if(in_array(end(explode(".", strtolower($file['name']))), $allowedExtensions))
        {
            if (($handle = fopen($source, "r")) !== FALSE)
            {
                // get the first (header) line
                $header = fgetcsv($handle, '1000');

                // get the rest of the rows
                $data = array();
                while ($row = fgetcsv($handle, '1000'))
                {
                    $arr = array();
                    foreach ($header as $i => $col)
                        $arr[$col] = $row[$i];
                    $data[] = $arr;
                }

                if($table == 'districts'){
                    $this->_importDistricts($data);
                }

                if($table == 'districts_relations'){
                    $this->_importRelations($data);
                }

                if($table == 'streets'){
                    $this->_importStreets($data);
                }

                if($table == 'news'){
                    $this->_importNews($data);
                }

                if($table == 'contacts'){
                    $this->_importContacts($data);
                }

                fclose($handle);
            }
        }
        return parent::save();
    }

    public function _importDistricts($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:districts.database.row.district');
            $row->id = $item['districts_district_id'];

            if(!$row->load())
            {
                $row->setData($item);
                $row->save();
            } else {
                $row->title = $item['title'];
                $row->slug = '';
                $row->save();
            }
        }
    }

    public function _importRelations($data)
    {
        // Empty districts_relations table
        $this->getObject('com:districts.model.relations')->getRowset()->delete();

        foreach($data as $item)
        {
            // Get CRAB ID
            $street = $this->getObject('com:streets.database.row.islp');
            $street->islp = $item['islp'];
            if($street->load())
            {
                $item['streets_street_id'] = $street->id;
            }

            $parity = null;
            switch ($item['range_parity']) {
                case 'Even+Oneven':
                    $parity = 'odd-even';
                    break;
                case 'Even':
                    $parity = 'even';
                    break;
                case 'Oneven':
                    $parity = 'odd';
                    break;
            }

            $item['range_parity'] = $parity;
            $item['id'] = sha1($item['districts_district_id'].$item['islp'].$item['range_start'].$item['range_end'].$item['range_parity']);

            // Add row to districts_relations table when ID is unique
            $row = $this->getObject('com:districts.database.row.relation');
            $row->id = $item['id'];
            if(!$row->load())
            {
                $row->setData($item);
                $row->save();
            }
        }
    }

    public function _importStreets($data)
    {
        foreach($data as $item)
        {
            //Get city based on postcode
            $city = $this->getObject('com:streets.database.row.postcodes');
            $city->streets_postcode_id = $item['postcode'];
            $city->load();

            //Get the street
            $street = $this->getObject('com:streets.database.row.streets');
            $street->title = $item['title'];
            $street->city = $city->streets_city_id;

            if($street->load()){
                //Check if street does not have a islp value
                if(!$street->islp) {
                    $islp = $this->getObject('com:streets.database.row.islp');

                    //Set ISLP value and save
                    $islp->id = $street->id;
                    $islp->islp = $item['islp'];
                    $islp->save();
                }
            }
        }
    }

    public function _importNews($data)
    {

        echo '<ol>';
        foreach($data as $item)
        {
            if($item['catid'] == $this->catid && $item['state'] == '1')
            {
                $row = $this->getObject('com:news.database.row.article');
                $row->id = $item['id'];

                if(!$row->load())
                {
                    $row->title = $item['title'];
                    $row->slug = $item['alias'];
                    $row->introtext = $item['introtext'];
                    $row->fulltext = $item['fulltext'];
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = $item['modified'];
                    $row->modified_by = $item['modified_by'];
                    $row->published = $item['state'];

                    $this->_extractImages($item['id'], $row->introtext);
                    // $this->_extractImages($row->fulltext);
                    //echo htmlentities($this->_replaceImages($row->introtext));
                    //echo "<p>--------------------------------------------------------------</p>";
                    $row->save();
                }
            }
        }
        echo '</ol>';
        exit();
    }

    protected function _extractImages($row, $html)
    {
        $html = trim($html);
        $html = stripslashes($html);

        if(empty($html)) {
            return;
        }

        $config = array(
            'indent'         => true,
            'output-xhtml'   => true,
            'wrap'           => 200
        );

        $tidy = new \tidy;
        $tidy->parseString($html, $config, 'utf8');
        $tidy->cleanRepair();

        $html = (string) $tidy;

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $images = $dom->getElementsByTagName('img');

        foreach($images as $image)
        {
            $link = $image->attributes->getNamedItem("src")->value;
            $link = urldecode($link);

            if(substr($link, 0, strlen('sites/')) == 'sites/')
            {
               // $fullpath = '/var/www/lokalepolitie.be/capistrano/shared/' . $link;
               $fullpath = '/var/www/police.dev/' . $link;

               $this->_saveAttachment($row, $fullpath);
            }
        }

        // Rebuild the HTML
        $rootnode = $dom->getELementsByTagName('body')->item(0);
        $html = '';
        foreach($rootnode->childNodes as $node){
            $html .= $dom->saveHTML($node);
        }
    }

    protected function _saveAttachment($row, $filepath)
    {
        if(!file_exists($filepath)) {
            return false;
        }

        echo "uploading " . $filepath . "<br />";

        $filename = basename($filepath);

        $request = $this->getObject('lib:controller.request', array(
            'query' => array(
                'container' => 'attachments-attachments'
            )
        ));

        $file_controller = $this->getObject('com:files.controller.file', array('request' => $request));

        $attachment_controller = $this->getObject('com:attachments.controller.attachment', array('request' => clone $request));
        
        try
        {
            $extension  = pathinfo($filename, PATHINFO_EXTENSION);
            $name       = md5(time().rand()).'.'.$extension;
            $hash       = md5_file($filepath);

            // Save file
            $file_controller->add(array(
                'file' => $filepath,
                'name' => $name,
                'parent' => ''
            ));

            // Save attachment
            $attachment_controller->add(array(
                'name' => $filename,
                'path' => $name,
                'container' => 'attachments-attachments',
                'hash' => $hash,
                'row' => $row,
                'table' => 'news'
            ));

            // Reset models
            $model  = $file_controller->getModel();
            $container = $model->getState()->container;

            $model->reset(false)->getState()->set('container', $container);

            $attachment_controller->getModel()->reset(false);

            // Clear the data in controllers for the next file
            $file_controller->getRequest()->data->clear();
            $attachment_controller->getRequest()->data->clear();
        }
        catch (Library\ControllerException $e) {
            return false;
        }

        return true;
    }

    public function _importContacts($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:contacts.database.row.contact');
            $row->id = $item['id'];

            if(!$row->load())
            {
                $row->name = $item['name'];
                $row->slug = $item['alias'];
                $row->position = $item['con_position'];
                $row->address = $item['address'];
                $row->suburb = $item['suburb'];
                $row->state = $item['state'];
                $row->country = $item['country'];
                $row->postcode = $item['postcode'];
                $row->telephone = $item['telephone'];
                $row->fax = $item['fax'];
                $row->mobile = $item['mobile'];
                $row->email_to = $item['email_to'];
                $row->misc = $item['misc'];
                $row->created_on = gmdate('Y-m-d H:i:s');
                $row->created_by = '1';
                $row->published = $item['published'];
                $row->ordering = '0';
                $row->save();
            }

        }
    }
}