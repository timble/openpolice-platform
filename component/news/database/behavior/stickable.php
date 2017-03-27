<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\News;

use Nooku\Library;

class DatabaseBehaviorStickable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        // Check if the row is setting the sticky field
        if($this->isModified('sticky') && $this->sticky == true)
        {
            // Find the existing article that is stickified
            $article = $this->getObject('com:news.database.row.article')->set('sticky', true);

            // Remove the sticky value
            if($article->load()) {
                $article->sticky = false;
                $article->save();
            }
        }
    }
}