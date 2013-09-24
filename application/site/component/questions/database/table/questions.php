<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Component\Questions;
use Nooku\Library;

class QuestionsDatabaseTableQuestions extends Questions\DatabaseTableQuestions
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'         => 'questions_view',
            'base'         => 'questions',
        ));

        parent::_initialize($config);
    }
}