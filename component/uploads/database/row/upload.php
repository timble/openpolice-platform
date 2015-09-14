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
        // Server, give us some time, please
        ini_set('max_execution_time', '600');

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

        if($table == 'wanted'){
            $this->_importWanted($data);
        }

        if($table == 'about'){
            $this->_importAbout($data);
        }

        return parent::save();
    }

    public function _importDistricts($data)
    {
        // Empty districts table
        if($this->override)
        {
            $this->getObject('com:districts.model.districts')->getRowset()->delete();
        }

        foreach($data as $item)
        {
            $row = $this->getObject('com:districts.database.row.district');
            $row->islp = $item['district_id'];

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
        if($this->override)
        {
            $this->getObject('com:districts.model.districts_officers')->getRowset()->delete();
        }

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
        if($this->override)
        {
            $this->getObject('com:districts.model.relations')->getRowset()->delete();
            $this->getObject('com:streets.model.relations')->table('districts_relations')->getRowset()->delete();
        }

        foreach($data as $item)
        {
            if(array_key_exists('street_id', $item))
            {
                $street = $this->getObject('com:streets.model.streets')->islp($item['street_id'])->getRowset();

                if(count($street))
                {
                    $item['streets_street_identifier'] = $street->top()->streets_street_identifier;
                } else {
                    continue;
                }
            } elseif(array_key_exists('street_title', $item)) {
                $street = $this->getObject('com:streets.model.streets')->title($item['street_title'])->city($item['city_id'])->getRowset();

                if(count($street))
                {
                    $item['streets_street_identifier'] = $street->top()->streets_street_identifier;
                } else {
                    continue;
                }
            }

            $parity = null;
            switch ($item['range_parity']) {
                case 'odd-even':
                case 'Even+Oneven':
                case 'Even/Oneven':
                case 'Even / Oneven':
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
                default:
                    $parity = 'odd-even';
                    break;
            }

            $item['range_parity'] = $parity;

            if(array_key_exists('district_id', $item))
            {
                $item['districts_district_id'] = $this->getObject('com:districts.model.district')->islp($item['district_id'])->getRow()->id;
            }

            // Add row to districts_relations table when ID is unique
            $row = $this->getObject('com:districts.database.row.relation');
            $row->setData($item);
            $row->save();

            // Add row to streets_relations
            $relation = $this->getObject('com:streets.database.row.relation');
            $relation->streets_street_identifier    = $item['streets_street_identifier'];
            $relation->row                          = $row->id;
            $relation->table                        = 'districts_relations';

            if(!$relation->load()) {
                $relation->save();
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
            $street = $this->getObject('com:streets.model.streets')->no_islp('1')->search($item['title'])->city($city->streets_city_id)->getRowset();

            //Did we found a street with no ISLP number?
            if($street)
            {
                $islp       = $this->getObject('com:streets.database.row.streets_islps');
                $islp->id   = $street->streets_street_identifier;
                $islp->islp = $item['islp'];
                $islp->save();
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
            $this->catid = $this->catid ? $this->catid : '1';
            $item['catid'] = isset($item['catid']) ? $item['catid'] : '1';

            if($item['catid'] == $this->catid && ($item['state'] == '1' || $item['state'] == '0'))
            {
                $row = $this->getObject('com:news.database.row.article');
                $row->id = $item['id'];

                // Only save when the row is new
                if(!$row->load())
                {
                    $row->title = $item['title'];
                    $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                    $row->introtext = isset($item['introtext']) ? stripslashes(html_entity_decode($item['introtext'])) : '';
                    $row->fulltext = isset($item['fulltext']) ? stripslashes(html_entity_decode($item['fulltext'])) : '';
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = isset($item['modified']) ? $item['modified'] : '';
                    $row->modified_by = isset($item['modified_by']) ? $item['modified_by'] : '';
                    $row->published = $item['state'];
                    $row->published_on = isset($item['publish_up']) ? $item['publish_up'] : $item['created'];

                    $this->_clean($row, 'news', true, 'introtext');

                    if($row->fulltext)
                    {
                        $this->_clean($row, 'news', true, 'fulltext');
                    }

                    $row->save();
                } elseif($this->override) {
                    $row->title = $item['title'];
                    $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                    $row->introtext = isset($item['introtext']) ? stripslashes(html_entity_decode($item['introtext'])) : '';
                    $row->fulltext = isset($item['fulltext']) ? stripslashes(html_entity_decode($item['fulltext'])) : '';
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->modified_on = isset($item['modified']) ? $item['modified'] : '';
                    $row->modified_by = isset($item['modified_by']) ? $item['modified_by'] : '';
                    $row->published = $item['state'];
                    $row->published_on = isset($item['publish_up']) ? $item['publish_up'] : $item['created'];

                    $this->_clean($row, 'news', false, 'introtext');

                    if($row->fulltext)
                    {
                        $this->_clean($row, 'news', false, 'fulltext');
                    }

                    $row->save();
                }
            }
        }
    }

    public function _importPress($data)
    {
        foreach($data as $item)
        {
            $this->catid = $this->catid ? $this->catid : '1';
            $item['catid'] = isset($item['catid']) ? $item['catid'] : '1';

            if($item['catid'] == $this->catid && ($item['state'] == '1' || $item['state'] == '0'))
            {
                $row = $this->getObject('com:press.database.row.article');
                $row->id = $item['id'];

                if(!$row->load())
                {
                    $row->title = $item['title'];
                    $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                    $row->introtext = isset($item['introtext']) ? stripslashes(html_entity_decode($item['introtext'])) : '';
                    $row->fulltext = isset($item['fulltext']) ? stripslashes(html_entity_decode($item['fulltext'])) : '';
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->published_on = $item['created'];
                    $row->modified_on = isset($item['modified']) ? $item['modified'] : '';
                    $row->modified_by = isset($item['modified_by']) ? $item['modified_by'] : '';
                    $row->published = $item['state'];

                    if($row->introtext)
                    {
                        $this->_clean($row, 'press', true, 'introtext');
                    }

                    if($row->fulltext)
                    {
                        $this->_clean($row, 'press', true, 'fulltext');
                    }

                    $row->text = $row->introtext.$row->fulltext;

                    $row->save();
                } elseif($this->override)
                {
                    $row->title = $item['title'];
                    $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                    $row->introtext = isset($item['introtext']) ? stripslashes(html_entity_decode($item['introtext'])) : '';
                    $row->fulltext = isset($item['fulltext']) ? stripslashes(html_entity_decode($item['fulltext'])) : '';
                    $row->created_on = $item['created'];
                    $row->created_by = '1';
                    $row->published_on = $item['created'];
                    $row->modified_on = isset($item['modified']) ? $item['modified'] : '';
                    $row->modified_by = isset($item['modified_by']) ? $item['modified_by'] : '';
                    $row->published = $item['state'];

                    if($row->introtext)
                    {
                        $this->_clean($row, 'press', false, 'introtext');
                    }

                    if($row->fulltext)
                    {
                        $this->_clean($row, 'press', false, 'fulltext');
                    }

                    $row->text = $row->introtext.$row->fulltext;

                    $row->save();
                }
            }
        }
    }

    public function _importAbout($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:about.database.row.article');
            $row->id = $item['id'];

            if(!$row->load())
            {
                $row->title = $item['title'];
                $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                $row->text = stripslashes(html_entity_decode($item['text']));
                $row->created_by = '1';
                $row->published = '1';
                $row->about_category_id = $item['about_category_id'];

                $this->_clean($row, 'about', true, 'text');

                $row->save();
            } elseif($this->override)
            {
                $row->title = $item['title'];
                $row->slug = isset($item['alias']) ? $item['alias'] : $this->getObject('lib:filter.slug')->sanitize($item['title']);
                $row->text = stripslashes(html_entity_decode($item['text']));
                $row->created_by = '1';
                $row->published = '1';
                $row->about_category_id = $item['about_category_id'];

                $this->_clean($row, 'about', false, 'text');

                $row->save();
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

    public function _importWanted($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:wanted.database.row.article');
            $row->id = $item['wanted_article_id'];

            // Only save when the row is new
            if(!$row->load())
            {
                $item['text'] = htmlspecialchars_decode($item['text']);
                $item['text'] = str_replace("/fedpol-blog/assets", "sites/fed/files/files/images", $item['text']);

                $row->wanted_category_id = $item['wanted_category_id'];
                $row->title = $item['title'];
                $row->slug = $this->getObject('lib:filter.slug')->sanitize($item['title']);
                $row->text = stripslashes(html_entity_decode($item['text']));
                $row->published_on = $item['pubdate'];
                $row->date = $item['factdate'];
                $row->case_id = $item['case_id'];
                $row->published = '1';
                $row->params = array('childfocus' => $item['childfocus'], 'place' => $item['place']);

                $this->_clean($row, 'wanted', true, 'text');

                $row->save();
            } elseif($this->override)
            {
                $item['text'] = htmlspecialchars_decode($item['text']);
                $item['text'] = str_replace("/fedpol-blog/assets", "sites/fed/files/files/images", $item['text']);

                $row->wanted_category_id = $item['wanted_category_id'];
                $row->title = $item['title'];
                $row->slug = $this->getObject('lib:filter.slug')->sanitize($item['title']);
                $row->text = stripslashes(html_entity_decode($item['text']));
                $row->published_on = $item['pubdate'];
                $row->date = $item['factdate'];
                $row->case_id = $item['case_id'];
                $row->published = '1';
                $row->params = array('childfocus' => $item['childfocus'], 'place' => $item['place']);

                $this->_clean($row, 'wanted', false, 'text');

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
                    $header = fgetcsv($handle, '0', ",");

                    // get the rest of the rows
                    while ($row = fgetcsv($handle, '0', ","))
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

    protected function _clean(Library\DatabaseRowAbstract $row, $table, $extractImages, $property)
    {
        $row->{$property} = preg_replace("/<em>/", "", $row->{$property});
        $row->{$property} = preg_replace("/<\/em>/", "", $row->{$property});

        $html = trim($row->{$property});
        $html = stripslashes($html);

        if(empty($html)) {
            continue;
        }

        $html = preg_replace("/<wbr ?>/", "", $html);
        $html = preg_replace("/<wbr ?\/>/", "", $html);

        $pattern = "/<a href=\"mailto:[a-z0-9\"' =:&;\-_%@]+>(\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b)<\/a>/i";
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

        $this->_extractYoutube($row, $dom, $table);

        $attachment = $this->_extractImages($row, $dom, $table, $extractImages);
        if(($property == 'introtext' || $property == 'text') && $attachment) {
            $row->attachments_attachment_id = $attachment;
        }

        $row->{$property} = $dom->saveHTML();
    }

    protected function _extractYoutube(Library\DatabaseRowAbstract $row, \DOMDocument $dom, $table)
    {
        $videos = $dom->getElementsByTagName('iframe');

        foreach($videos as $video)
        {
            if(strpos($video->attributes->getNamedItem("src")->value, 'youtu') !== false )
            {
                // Get the video ID, last part in www.youtube.com/embed/KoMUYBnlvm8?rel=0
                $link = end(explode('/',$video->attributes->getNamedItem("src")->value));

                $row->params = array('youtube' => 'http://www.youtube.com?v='.$link);

                // Only get the first video
                break;
            }
        }
    }

    protected function _extractImages(Library\DatabaseRowAbstract $row, \DOMDocument $dom, $table, $extractImages)
    {
        $root   = $this->getObject('application')->getCfg('old_codebase_root');
        if(empty($root)) {
            $root = '/var/www/police.dev';
        }

        if($table != 'wanted')
        {
            $images = $dom->getElementsByTagName('img');
        }
        else
        {
            $images = array();

            foreach($dom->getElementsByTagName('a') as $link)
            {
                $href = $link->attributes->getNamedItem("href")->value;

                // Check if the link is pointing to a local image
                if(strpos($href, 'sites/fed/files/files/images/') !== false && strpos($href, 'pixel_bis.jpg') == false && strpos($href, 'dour1.jpg') == false)
                {
                    $images[] = $link;
                }
            }
        }

        $attachment = false;
        foreach($images as $image)
        {
            if($table != 'wanted')
            {
                $link = $image->attributes->getNamedItem("src")->value;
            }
            else {
                $link = $image->attributes->getNamedItem("href")->value;
            }

            $link = urldecode($link);

            if(substr($link, 0, strlen('sites/')) == 'sites/')
            {
                $fullpath  = $root . '/' . $link;
                $extension = $this->_getFileExtension($fullpath);
                $allowed   = in_array($extension, array('jpg', 'jpeg', 'png'));

                if($allowed && file_exists($fullpath))
                {
                    $filesize  = filesize($fullpath);

                    list($width, $height) = getimagesize($fullpath);

                    if ($extractImages && $allowed && $filesize < 10485760 && $width <= 2048 && $height <= 2048) {
                        $return = $this->_saveAttachment($row, $fullpath, $table);
                    }
                    else $return = false;

                    if(!$attachment) {
                        $attachment = $return;
                    }
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

        $request         = $this->getObject('lib:controller.request', array('query' => array('container' => $table == 'wanted' ? 'attachments-wanted' : 'attachments-attachments')));
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
                'container' => $table == 'wanted' ? 'attachments-wanted' : 'attachments-attachments',
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
