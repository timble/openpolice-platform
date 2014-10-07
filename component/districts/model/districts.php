<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class ModelDistricts extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('islp' , 'string');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'contact'       => 'contact.title'
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

        if ($state->islp) {
            $query->where('tbl.islp = :islp')->bind(array('islp' => $state->islp));
        }
	}
}