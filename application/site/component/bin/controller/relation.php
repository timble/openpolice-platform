<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class BinControllerRelation extends Library\ControllerModel
{
    public function _actionBrowse(Library\CommandContext $context)
    {
        $relations = parent::_actionBrowse($context);

        $data        = $context->request->data;
        $street      = isset($context->request->getUrl()->query['street']) ? $context->request->getUrl()->query['street'] : false;
        $number      = isset($context->request->getUrl()->query['number']) ? $context->request->getUrl()->query['number'] : false;

        if($number != '' && $street) {
            $relation = $relations->top();

            // Redirect the user if the request doesn't include layout=form
            if ($context->request->getFormat() == 'html')
            {
                if ($relation->bin_district_id) {
                    $district = $this->getObject('com:bin.model.district')->id($relation->bin_district_id)->getRow();

                    $url = clone($context->request->getUrl());
                    $url->query['view'] = 'district';
                    $url->query['option'] = 'com_bin';
                    $url->query['id'] = $district->getSlug();

                    $this->getObject('application')->getRouter()->build($url);

                    return $this->getObject('component')->redirect($url);
                }
            }
        }

        return $relations;
    }
}
