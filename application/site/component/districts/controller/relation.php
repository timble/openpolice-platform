<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsControllerRelation extends Library\ControllerModel
{
    public function _actionBrowse(Library\CommandContext $context)
    {
        $relations = parent::_actionBrowse($context);

        if(count($relations) == '1') {
            foreach($relations as $relation) {
                // Redirect the user if the request doesn't include layout=form
                if ($context->request->getFormat() == 'html')
                {
                    if ($relation->districts_district_id) {
                        $district = $this->getObject('com:districts.model.district')->id($relation->districts_district_id)->getRow();

                        $url = clone($context->request->getUrl());
                        $url->query['view'] = 'district';
                        $url->query['option'] = 'com_districts';
                        $url->query['id'] = $district->getSlug();
                        unset($url->query['street']);

                        $this->getObject('application')->getRouter()->build($url);

                        return $this->getObject('application')->redirect($url);
                    }
                }
            }
        }

        return $relations;
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        if(!$request->query->street) {
            $request->query->view = 'search';
        }

        return $request;
    }
}