<?php
use Nooku\Library;
use Nooku\Component\Support;

class SupportControllerComment extends Support\ControllerComment
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback('before.add'  , array($this, 'setDatabase'));
        $this->registerCallback('after.add'  , array($this, 'resetDatabase'));
    }

    public function setDatabase(Library\CommandContext $context)
    {
        $data = $context->request->data;

        if ($db = $data->get('zone', 'int'))
        {
            $adapter = $this->getObject('lib:database.adapter.mysql');

            if ($adapter->getDatabase() != $db) {
                $adapter->setDatabase($db);
            }
        }
    }

    public function resetDatabase(Library\CommandContext $context)
    {
        $adapter = $this->getObject('lib:database.adapter.mysql');
        $db      = $this->getObject('application')->getCfg('db');

        if ($db != $adapter->getDatabase()) {
            $adapter->setDatabase($db);
        }
    }
}
