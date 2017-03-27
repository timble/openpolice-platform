<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Wanted;
use Nooku\Library;

class ModelArticles extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('published'        , 'int')
            ->insert('solved'           , 'int')
            ->insert('section'          , 'string')
            ->insert('category'         , 'string')
            ->insert('sort'             , 'cmd'     , 'ordering_date')
            ->insert('direction'        , 'cmd'     , 'DESC');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'thumbnail'         => 'attachments.path',
            'wanted_section_id' => 'sections.wanted_section_id',
            'city'              => 'city.title',
            'ordering_date'     => 'IF(tbl.published_on, tbl.published_on, tbl.publish_on)',
            'draft'             => 'IF(tbl.published_on OR tbl.publish_on, 0, 1)',
            'section_slug'      => 'sections.slug',
            'category_slug'     => 'categories.slug'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $languages = $this->getObject('application.languages');
        $language = $languages->getActive()->slug;

        $query->join(array('categories' => 'wanted_categories'), 'categories.wanted_category_id = tbl.wanted_category_id')
              ->join(array('sections' => 'wanted_sections'), 'sections.wanted_section_id = categories.wanted_section_id')
              ->join(array('attachments' => 'attachments'), 'attachments.attachments_attachment_id = tbl.attachments_attachment_id')
              ->join(array('city' => $language == 'fr' ? 'data.fr-be_streets_cities' : 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
        }

        if (is_numeric($state->published)) {
            $query->where('tbl.published = :published')->bind(array('published' => $state->published));
        }

        if (is_numeric($state->solved)) {
            $query->where('tbl.solved = :solved')->bind(array('solved' => $state->solved));
        }

        if (is_numeric($state->section)) {
            $query->where('categories.wanted_section_id = :section')->bind(array('section' => $state->section));
        }

        if(!is_numeric($state->section) && !is_null($state->section)) {
            $query->where('sections.slug = :section')->bind(array('section' => $state->section));
        }

        if (is_numeric($state->category)) {
            $query->where('categories.wanted_category_id = :category')->bind(array('category' => $state->category));
        }

        if(!is_numeric($state->category) && !is_null($state->category)) {
            $query->where('categories.slug = :category')->bind(array('category' => $state->category));
        }
    }

    protected function _buildQueryOrder(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        if ($state->sort == 'ordering_date')
        {
            $query->order('draft', $state->direction)
                ->order('ordering_date', $state->direction);
        } else {
            $query->order($state->sort, strtoupper($state->direction));
        }
    }
}