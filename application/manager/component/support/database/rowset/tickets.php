<?php
use Nooku\Library;

class SupportDatabaseRowsetTickets extends Library\DatabaseRowsetAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'id'
        ));

        parent::_initialize($config);
    }
}