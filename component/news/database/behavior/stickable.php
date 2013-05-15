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

class DatabaseBehaviorStickable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        // Set home.
        if($this->isModified('sticky') && $this->sticky == 1)
        {
            $article = $this->getObject('com:news.database.table.articles')
                ->select(array('sticky' => 1), Library\Database::FETCH_ROW);

            $article->sticky = 0;
            $article->save();
        }
    }
}