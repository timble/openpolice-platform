<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class ModelDistricts extends Library\ModelTable
{
	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'contact'       => 'contact.name'
		));
	}

	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('contact' => 'contacts'), 'contact.contacts_contact_id = tbl.contacts_contact_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
	}

    public function getOfficers()
    {
        $model = $this->getObject('com:districts.model.districts_officers');

        if(!$this->_row->isNew())
        {
            $officers = $model->officer($this->_row->id)->getRowset();

        } else $officers = $model->getRow();

        return $officers;
    }
}