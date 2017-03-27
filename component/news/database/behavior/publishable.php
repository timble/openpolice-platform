<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\News;

use Nooku\Library;

/**
 * Publishable Database Behavior
 *
 * Auto publishes/un-publishes items.
 *
 * @author  Arunas Mazeika <http://nooku.assembla.com/profile/arunasmazeika>
 * @package Nooku\Component\News
 */
class DatabaseBehaviorPublishable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Track updated status
     *
     * Variable keeps track of the updated status of the items table. A value of true indicates that items are
     * already up to date, i.e. published according with the current timestamp.
     *
     * @var bool
     */
    protected $_uptodate = false;

    /**
     * The name of the table containing the publishable items.
     *
     * @var string
     */
    protected $_table;

    /**
     * The current date.
     *
     * @var Library\Date The current date.
     */
    protected $_date;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_table = $config->table;
        $this->_date  = new Library\Date(array('timezone' => 'GMT'));
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'table'=> 'news'
        ));

        parent::_initialize($config);
    }

    protected function _beforeTableSelect(Library\CommandContext $context)
    {
        if (!$this->_uptodate)
        {
            $this->_publishItems($context);

            $this->_uptodate = true;
        }
    }

    protected function _beforeTableInsert(Library\CommandContext $context)
    {
        // Same as update.
        $this->_beforeTableUpdate($context);
    }

    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        $data = $context->data;

        // If publish_on is modified then convert it to GMT/UTC
        if($data->isModified('publish_on') && $data->publish_on)
        {
            $data->publish_on = gmdate('Y-m-d H:i:s', strtotime($data->publish_on));
        }

        // Un-publish the item
        if ($data->published && (strtotime($data->publish_on) > $this->_date->getTimestamp())) {
            $data->published = 0;
        }

        // Set publish_on to current date when the field is empty and row is published
        if ($data->published && !strtotime($data->published_on))
        {
            $data->published_on = gmdate('Y-m-d H:i:s', $this->_date->getTimestamp());
        }
    }

    /**
     * Publishes items given a date.
     */
    protected function _publishItems($context)
    {
        $query = $this->_getQuery();

        $query->where('publish_on <= :date')->where('published = :published')->where('publish_on IS NOT NULL')
            ->values(array('published = :value', 'published_on = publish_on', 'publish_on = NULL'))
            ->bind(array('date'      => $this->_date->format('Y-m-d H:i:s'),
                'published' => 0,
                'value'     => 1));

        $this->getMixer()->getAdapter()->update($query);
    }

    /**
     * Generic query getter.
     *
     * @return object A query object.
     */
    protected function _getQuery()
    {
        $query = $this->getObject('lib:database.query.update');
        $query->table(array($this->_table));

        return $query;
    }
}
