<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Forms;
use Nooku\Library;

class ModelEntries extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('form' , 'int')
            ->insert('is_valid' , 'int')
            ->insert('sort'             , 'cmd'     , 'created_on')
            ->insert('direction'        , 'cmd'     , 'DESC');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'form' => 'forms.title'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('forms'  => 'forms'), 'forms.forms_form_id = tbl.forms_form_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.email LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
        }

        if (is_numeric($state->form)) {
            $query->where('tbl.forms_form_id = :form')->bind(array('form' => $state->form));
        }

        if (is_numeric($state->is_valid)) {
            $query->where('tbl.is_valid = :is_valid')->bind(array('is_valid' => $state->is_valid));
        }
    }
}