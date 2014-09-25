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
    public function save()
    {
        $table  = $this->table;

        $file   = $this->getObject('lib:dispatcher.request')->files->file;
        $data   = $this->_loadData($file);

        if($table == 'districts'){
            $this->_importDistricts($data);
        }

        if($table == 'districts_officers'){
            $this->_importDistrictsofficers($data);
        }

        if($table == 'districts_relations'){
            $this->_importRelations($data);
        }

        if($table == 'localstreets'){
            $this->_importLocalStreets($data);
        }

        if($table == 'officers'){
            $this->_importOfficers($data);
        }

        if($table == 'news'){
            $this->_importNews($data);
        }

        if($table == 'press'){
            $this->_importPress($data);
        }

        if($table == 'contacts'){
            $this->_importContacts($data);
        }

        if($table == 'streets'){
            $this->_importStreets($data);
        }

        return parent::save();
    }

    public function _importDistricts($data)
    {
        // Empty districts table
        $this->getObject('com:districts.model.districts')->getRowset()->delete();

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

    public function _importOfficers($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:districts.database.row.officer');
            $row->id = $item['number'];

            if(!$row->load())
            {
                $row->firstname = $item['firstname'];
                $row->lastname = $item['lastname'];
                $row->phone = preg_replace('/[^0-9+]/', " ", $item['phone']);
                $row->mobile = preg_replace('/[^0-9+]/', " ", $item['mobile']);
                $row->email = $item['email'];
            } else {
                $row->firstname = $item['firstname'];
                $row->lastname = $item['lastname'];
                $row->phone = preg_replace('/[^0-9+]/', " ", $item['phone']);
                $row->mobile = preg_replace('/[^0-9+]/', " ", $item['mobile']);
                $row->email = $item['email'];
            }

            $row->save();
        }
    }

    public function _importDistrictsofficers($data)
    {
        // Empty districts_districts_officers table
        $this->getObject('com:districts.model.districts_officers')->getRowset()->delete();

        foreach($data as $item)
        {
            $row = $this->getObject('com:districts.database.row.districts_officers');
            $row->districts_district_id = $item['districts_district_id'];
            $row->districts_officer_id = $item['districts_officer_id'];

            if(!$row->load())
            {
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
            if(!array_key_exists('streets_street_id', $item))
            {
                $street = $this->getObject('com:streets.model.streets')->islp($item['islp'])->getRowset();

                if(count($street))
                {
                    $item['streets_street_id'] = $street->top()->id;
                } else {
                    $item['streets_street_id'] = '';
                }
            } else {
                $item['islp'] = '';
            }

            $parity = null;
            switch ($item['range_parity']) {
                case 'odd-even':
                case 'Even+Oneven':
                case 'Even/Oneven':
                case 'Pair+Impair':
                case 'Pair/Impair':
                    $parity = 'odd-even';
                    break;
                case 'even':
                case 'Even':
                case 'Pair':
                    $parity = 'even';
                    break;
                case 'odd':
                case 'Oneven':
                case 'Impair':
                    $parity = 'odd';
                    break;
            }

            $item['range_parity'] = $parity;
            $item['id'] = sha1($item['districts_district_id'].$item['islp'].$item['streets_street_id'].$item['range_start'].$item['range_end'].$item['range_parity']);

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

    public function _importLocalStreets($data)
    {
        foreach($data as $item)
        {
            //Get city based on postcode
            $city = $this->getObject('com:streets.database.row.postcodes');
            $city->id = $item['postcode'];
            $city->load();

            //Get the street
            $street = $this->getObject('com:streets.database.row.streets');
            $street->title = $item['title'];
            $street->streets_city_id = $city->streets_city_id;

            if($street->load()){
                //Check if street does not have a islp value
                if(!$street->islp) {
                    //Set ISLP value and save
                    $street->islp = $item['islp'];
                    $street->save();
                }
            }
        }
    }

    public function _importStreets($data)
    {
        foreach($data as $item)
        {
            //Get the street
            $row = $this->getObject('com:streets.database.row.streets');
            $row->id = $item['id'];

            if($row->load()){
                if($row->title != $item['title'] || $row->title0 != $item['title0']) {
                    $row->setData($item);
                    $row->save();
                }
            } else {
                $row->setData($item);
                $row->save();
            }
        }
    }

    public function _importNews($data)
    {
        foreach($data as $item)
        {
            if($item['catid'] == $this->catid && ($item['state'] == '1' || $item['state'] == '0'))
            {
                $row = $this->getObject('com:news.database.row.article');
                $row->id = $item['id'];

                // Only save the attachments when the row is new
                if(!$row->load())
                {
                    $row->title = $item['title'];
                    $row->slug = $item['alias'];
                    $row->introtext = stripslashes($item['introtext']);
                    $row->fulltext = stripslashes($item['fulltext']);
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = $item['modified'];
                    $row->modified_by = $item['modified_by'];
                    $row->published = $item['state'];
                    $row->published_on = $item['publish_up'];

                    $this->_clean($row, 'news', true);
                } else {
                    $row->title = $item['title'];
                    $row->slug = $item['alias'];
                    $row->introtext = stripslashes($item['introtext']);
                    $row->fulltext = stripslashes($item['fulltext']);
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = $item['modified'];
                    $row->modified_by = $item['modified_by'];
                    $row->published = $item['state'];
                    $row->published_on = $item['publish_up'];

                    $this->_clean($row, 'news', false);
                }
                
                $row->save();
            }
        }
    }

    public function _importPress($data)
    {
        foreach($data as $item)
        {
            if($item['catid'] == $this->catid && ($item['state'] == '1' || $item['state'] == '0'))
            {
                $row = $this->getObject('com:press.database.row.article');
                $row->id = $item['id'];

                if(!$row->load())
                {
                    $row->title = $item['title'];
                    $row->slug = $item['alias'];
                    $row->introtext = stripslashes($item['introtext']);
                    $row->fulltext = stripslashes($item['fulltext']);
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = $item['modified'];
                    $row->modified_by = $item['modified_by'];
                    $row->published = $item['state'];

                    $this->_clean($row, 'press', true);

                    $row->text = $row->introtext.$row->fulltext;

                    $row->save();
                }
            }
        }
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

    protected function _loadData(array $file)
    {
        if (!file_exists($file['tmp_name'])) {
            throw new \UnexpectedValueException('Temporary uploaded file does not exist: ' . $file['tmp_name']);
        }

        $data      = array();
        $extension = $this->_getFileExtension($file['name']);

        switch ($extension)
        {
            case 'csv':
                if (($handle = fopen($file['tmp_name'], 'r')) !== FALSE)
                {
                    // get the first (header) line
                    $header = fgetcsv($handle, '1000');

                    // get the rest of the rows
                    while ($row = fgetcsv($handle, '1000'))
                    {
                        $arr = array();

                        foreach ($header as $i => $col) {
                            $arr[$col] = $row[$i];
                        }

                        // Use ID as key if it
                        if (array_key_exists('id', $arr)) {
                            $data[$arr['id']] = $arr;
                        } else {
                            $data[] = $arr;
                        }
                    }

                    fclose($handle);
                }
                else throw new \Exception('Failed to read ' . $file['tmp_name']);
                break;

            case 'xml':
                $string = file_get_contents($file['tmp_name']);

                if ($string === false) {
                    throw new \Exception('Failed to read ' . $file['tmp_name']);
                }

                $xml = simplexml_load_string($string);

                if ($xml === false) {
                    throw new \UnexpectedValueException('Could not parse ' . $file['name']);
                }

                foreach ($xml->database->table_data->row as $row)
                {
                    $arr = array();

                    foreach ($row->field as $field)
                    {
                        $key       = (string) $field['name'];
                        $arr[$key] = (string) $field;
                    }

                    // Use ID as key if it
                    if (array_key_exists('id', $arr)) {
                        $data[$arr['id']] = $arr;
                    } else {
                        $data[] = $arr;
                    }
                }

                break;

            default:
                throw new \UnexpectedValueException($file['name'] . ' is not a CSV or XML file!');
                break;
        }

        ksort($data);

        return $data;
    }

    protected function _clean(Library\DatabaseRowAbstract $row, $table, $extractImages)
    {
        $row->introtext = preg_replace("/<em>/", "", $row->introtext);
        $row->introtext = preg_replace("/<\/em>/", "", $row->introtext);

        foreach(array('introtext', 'fulltext') as $property)
        {
            $html = trim($row->{$property});
            $html = stripslashes($html);

            if(empty($html)) {
                continue;
            }

            $pattern = "/<a href=\"mailto:[a-z0-9\"' =:&;\-_]+>(\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b)<\/a>/i";
            $html    = preg_replace($pattern, '<a href="mailto:$1">$1</a>', $html);

            $config = array(
                'indent'         => true,
                'output-xhtml'   => true,
                'wrap'           => 200
            );

            $tidy = new \tidy;
            $tidy->parseString($html, $config, 'utf8');
            $tidy->cleanRepair();

            $html = (string) $tidy;

            // Deal with DOMDocument breaking UTF-8 characters
            // See: http://stackoverflow.com/questions/11309194/php-domdocument-failing-to-handle-utf-8-characters
            $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

            $dom = new \DOMDocument();
            $dom->loadHTML('<?xml encoding="UTF-8">' . $html);

            $this->_cleanAttributes($dom);

            $attachment = $this->_extractImages($row, $dom, $table, $extractImages);
            if($property == 'introtext' && $attachment) {
                $row->attachments_attachment_id = $attachment;
            }

            $row->{$property} = $dom->saveHTML();
        }
    }

    protected function _extractImages(Library\DatabaseRowAbstract $row, \DOMDocument $dom, $table, $extractImages)
    {
        $root   = $this->getObject('application')->getCfg('old_codebase_root');
        if(empty($root)) {
            $root = '/var/www/police.dev';
        }

        $images = $dom->getElementsByTagName('img');

        $attachment = false;
        foreach($images as $image)
        {
            $link = $image->attributes->getNamedItem("src")->value;
            $link = urldecode($link);

            if(substr($link, 0, strlen('sites/')) == 'sites/')
            {
                $fullpath  = $root . '/' . $link;
                $extension = $this->_getFileExtension($fullpath);
                $filesize  = filesize($fullpath);
                $allowed   = in_array($extension, array('jpg', 'jpeg', 'png'));

                list($width, $height) = getimagesize($fullpath);

                if ($extractImages && $allowed && $filesize < 10485760 && $width <= 2048 && $height <= 2048) {
                    $return = $this->_saveAttachment($row, $fullpath, $table);
                }
                else $return = false;

                if(!$attachment) {
                    $attachment = $return;
                }

                $image->parentNode->removeChild($image);
            }
        }

        return $attachment;
    }

    protected function _cleanAttributes(\DOMDocument $dom)
    {
        foreach($dom->getElementsByTagName("div") as $div)
        {
            $div->removeAttribute('style');
            $div->removeAttribute('class');
        }

        foreach($dom->getElementsByTagName('p') as $paragraph)
        {
            $paragraph->removeAttribute('style');
            $paragraph->removeAttribute('class');
        }
    }

    protected function _saveAttachment(Library\DatabaseRowAbstract $row, $filepath, $table)
    {
        if(!file_exists($filepath)) {
            return false;
        }

        $filename = basename($filepath);

        $request         = $this->getObject('lib:controller.request', array('query' => array('container' => 'attachments-attachments')));
        $file_controller = $this->getObject('com:files.controller.file', array('request' => $request));
        $attachment_controller = $this->getObject('com:attachments.controller.attachment', array('request' => clone $request));
        
        try
        {
            $extension  = pathinfo($filename, PATHINFO_EXTENSION);
            $name       = md5(time().rand()).'.'.$extension;
            $hash       = md5_file($filepath);

            // @TODO don't suppress errors
            // DatabaseRowUrl in com:files will get called and try to open the file through fsockopen.
            // Although fsockopen is suppressed using the @-notation, the error handler tries to throw it, resulting in a blank page.
            // Since our files are not uploaded files (See: CommandValidatorFile), this error can be dismissed and should be ignored.
            $file_controller->add(array(
                'file' => $filepath,
                'name' => $name,
                'parent' => ''
            ));

            $entity = $attachment_controller->add(array(
                'name' => $filename,
                'path' => $name,
                'container' => 'attachments-attachments',
                'hash' => $hash,
                'row' => $row->id,
                'table' => $table
            ));

            $model  = $file_controller->getModel();
            $container = $model->getState()->container;

            $model->reset(false)->getState()->set('container', $container);
            $attachment_controller->getModel()->reset(false);

            $file_controller->getRequest()->data->clear();
            $attachment_controller->getRequest()->data->clear();

            return $entity->id;
        }
        catch (Library\ControllerException $e) {
            return false;
        }

        return false;
    }

    protected function _getFileExtension($filename)
    {
        return end(explode('.', strtolower($filename)));
    }
}