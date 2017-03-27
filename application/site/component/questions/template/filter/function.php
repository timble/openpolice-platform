<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
use Nooku\Library;

class QuestionsTemplateFilterFunction extends Library\TemplateFilterFunction
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->addFunction('highlight', '$this->getView()->highlight(');
    }
}