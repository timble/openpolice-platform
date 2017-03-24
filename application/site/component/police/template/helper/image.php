<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Image Template Helper
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Attachments
 */
class PoliceTemplateHelperImage extends Library\TemplateHelperDefault
{
    public function thumbnail($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'attachment' => false,
            'attribs' => array(),
            'url' => 'relative'
        ));

        //Make sure the attachment is set
        if($config->attachment) {
            $thumbnail = $this->getObject('com:attachments.database.row.attachment')->set('id', $config->attachment)->load();

            //Make sure the thumbnail exist
            if($thumbnail) {
                if(!$config->attribs->alt)
                {
                    $config->attribs->alt = ucfirst(preg_replace('#[-_\s\.]+#i', ' ', pathinfo($thumbnail->name, PATHINFO_FILENAME)));
                }

                $src = '';

                if($config->url == 'absolute')
                {
                    $src .= 'http://'.$this->getObject('request')->getUrl()->getHost();
                }

                $src  .= 'attachments://'.$thumbnail->thumbnail;

                return '<img '.$this->buildAttributes($config->attribs).' src="'.$src.'" />';
            }
        }

        return false;
    }

    public function picture($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'attachment' => false,
            'attribs' => array(),
            'parameters' => array('auto' => 'format', 'q' => '80', 'fit' => 'crop', 'bg' => 'FFFFFF'),
            'ratio' => '2/1',
            'srcset' => array(),
            'sizes' => array(),
            'max_width' => false
        ));

        if(!$config->max_width)
        {
            $config->max_width = $config->srcset[count($config->srcset) - 1];
        }

        $thumbnail = $this->getObject('com:attachments.database.row.attachment')->set('id', $config->attachment)->load();

        //Make sure the attachment is set
        if($thumbnail)
        {
            $widths = array();
            $srcset = array();
            $sizes = array();

            // Add retina sizes
            foreach ($config->srcset as $width)
            {
                $widths[] = $width;
                $widths[] = $width * 2;
            }

            // Sort array
            asort($widths);

            foreach ($widths as $width)
            {
                $srcset[] = $this->buildSource($config, $thumbnail, $width, true);
            }

            foreach ($config->sizes as $viewport => $image_width)
            {
                $sizes[] = '(min-width: '.$viewport.') '.$image_width;
            }

            $return = '<img';
            $return .= ' src="'.$this->buildSource($config, $thumbnail, $config->max_width).'"';
            $return .= ' '.$this->buildAttributes($config->attribs);
            $return .= ' srcset="'.implode(', ',$srcset).'"';
            $return .= ' sizes="'.implode(', ',$sizes).'"';
            $return .= ' >';

            return $return;
        }

        return false;
    }

    public function buildSource($config, $thumbnail, $width, $srcset = false)
    {
        $source = $this->getObject('application')->getCfg('imgix', '');
        $source .= 'attachments://'.$thumbnail->path;

        $ratio = explode('/', $config->ratio);
        $ratio = $ratio[0] / $ratio[1];

        $sizes = array(
            'w' => $width,
            'h' => $config->ratio ? round($width / $ratio) : ''
        );

        $query = array_merge($config['parameters'], $sizes);

        $source .= '?'.http_build_query((array) $query);
        $source .= $srcset ? ' '.$width.'w' : '';

        return $source;
    }
}
