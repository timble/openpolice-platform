<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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