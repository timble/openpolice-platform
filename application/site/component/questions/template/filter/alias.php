<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsTemplateFilterAlias extends Library\TemplateFilterAlias
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->addAlias(array('@highlight(' => '$this->getView()->highlight('), Library\TemplateFilter::MODE_COMPILE);
    }
}