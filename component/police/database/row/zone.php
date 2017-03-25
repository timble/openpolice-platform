<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class DatabaseRowZone extends Library\DatabaseRowTable
{
    private static $__socialMedia = array('twitter', 'facebook', 'instagram', 'youtube');

    public function __get($column)
    {
        $language = $this->getObject('application.languages')->getActive()->slug;

        if($column == 'title' && !isset($this->_data['title']))
        {
            $titles = json_decode($this->_data['titles'], true);

            if (is_array($titles))
            {
                if (isset($titles[$language])) {
                    $this->_data['title'] = $titles[$language];
                }
                else $this->_data['title'] = array_shift(array_values($titles));
            }
        }

        if (in_array($column, self::$__socialMedia) && !isset($this->_data[$column])) {
            $this->_data[$column] = $this->_getSocialAccount($column);
        }

        return parent::__get($column);
    }

    protected function _getSocialAccount($medium)
    {
        if (!in_array($medium, self::$__socialMedia)) {
            return null;
        }

        $language = $this->getObject('application.languages')->getActive()->slug;
        $social   = json_decode($this->_data['social'], true);

        if (isset($social[$medium]) && is_array($social[$medium]) && count($social[$medium]))
        {
            $accounts = $social[$medium];

            if (($accounts[$language])) {
                return $accounts[$language];
            }

            $values = array_values($social[$medium]);

            return array_shift($values);
        }

        return null;
    }

    /**
     * Saves the zone to the database.
     *
     * @return boolean	If successfull return TRUE, otherwise FALSE
     */
    public function save()
    {
        if ($this->isModified('titles'))
        {
            $this->titles = array_filter($this->_data['titles']);
            $this->titles = json_encode($this->titles);
        }

        return parent::save();
    }
}