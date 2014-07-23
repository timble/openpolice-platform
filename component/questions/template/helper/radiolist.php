<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Questions;

use Nooku\Library;

/**
 * Radiolist Template Helper
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Categories
 */
class TemplateHelperRadiolist extends Library\TemplateHelperSelect
{
    public function categories($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'name'          => 'questions_category_id',
            'row'           => '',
            'package'       => 'questions',
            'model'         => 'categories',
            ))->append(array(
                'selected'      => $config->row->{$config->name},
            ))->append(array(
                'filter' 	=> array(
                    'sort'      => 'title',
                ),
            ));

        $identifier = 'com:'.$config->package.'.model.'.($config->model ? $config->model : Library\StringInflector::pluralize($config->package));

        $categories = $this->getObject($identifier)
            ->setState(Library\ObjectConfig::unbox($config->filter))
            ->getRowset();

        $options = $this->options(array(
            'entity' => $categories,
            'value'  => 'id',
            'label'  => 'title',
        ));

        //Add the options to the config object
        $config->options = $options;

        return parent::radiolist($config);
    }
}