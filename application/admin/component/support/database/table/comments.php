<?php

use Nooku\Library;
use Nooku\Component\Comments;

class SupportDatabaseTableComments extends Comments\DatabaseTableComments
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'com:attachments.database.behavior.attachable'
            )
        ));

        parent::_initialize($config);
    }
}