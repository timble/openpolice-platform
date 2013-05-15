<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\News;
use Nooku\Library;

//TODO: Make the DatabaseBehaviorAssignable in com:articles generic so this class can be removed
class DatabaseBehaviorAssignable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        $data = $context->data;

        if($data->assign)
        {
            $attachment =  $this->getObject('com:attachments.model.attachments')
                ->id($data->id)
                ->getRow();

            $article =  $this->getObject('com:news.model.articles')
                ->id($attachment->relation->row)
                ->getRow();

            if($article->image == $attachment->path)
            {
                // Toggle to remove the image
                $article->image = null;
            }
            else
            {
                $article->image = $attachment->path;
            }

            $article->save();
        }

        return true;
    }
}