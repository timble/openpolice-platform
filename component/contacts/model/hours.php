<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

/**
 * Hours Model
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Contacts
 */
class ModelHours extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
            ->insert('published', 'boolean')
            ->insert('contact' , 'int', $this->getObject('com:contacts.model.contacts')->sort(array('contacts_category_id', 'title'))->getRowset()->top()->id);
	}
	
	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'contact'  => 'contacts.name'
		));
	}
	
	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('contacts' => 'contacts'), 'contacts.contacts_contact_id = tbl.contacts_contact_id');
	}
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

        if (is_bool($state->published)) {
            $query->where('tbl.published = :published')->bind(array('published' => (int) $state->published));
        }
		
		if ($state->contact) {
			$query->where('tbl.contacts_contact_id = :contact')->bind(array('contact' => (int) $state->contact));
		}
	}
    
    protected function _buildQueryOrder(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $direction = strtoupper($state->direction);
        
        $query->order('contacts.ordering', 'ASC');
        $query->order('tbl.date', $direction);
        $query->order('tbl.day_of_week', $direction);
        $query->order('tbl.opening_time', $direction);
    }
}