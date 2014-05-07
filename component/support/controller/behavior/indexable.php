<?php
namespace Nooku\Component\Support;

use Nooku\Library;
use Nooku\Component\Elasticsearch;

class ControllerBehaviorIndexable extends Elasticsearch\ControllerBehaviorIndexable
{
    public function indexDocument(Library\CommandContext $commandContext)
    {
        $entity = $commandContext->result;
        $entity->zone = $this->getObject('application')->getSite();

        if ($entity->getIdentifier()->name == 'ticket')
        {
            if ($entity->getStatus() == Library\Database::STATUS_CREATED)
            {
                $entity->last_activity_on = $entity->created_on;
                $entity->last_activity_by = $entity->created_by;
            }
            else
            {
                $entity->last_activity_on = $entity->modified_on;
                $entity->last_activity_by = $entity->modified_by;
            }
        }
        else
        {
            if ($entity->getStatus() == Library\Database::STATUS_CREATED)
            {
                $ticket = $this->getObject('com:support.model.tickets')
                    ->id($entity->get('row', 'int'))
                    ->getRow();

                $ticket->last_activity_on = gmdate('Y-m-d H:i:s');
                $ticket->last_activity_by = (int) $this->getObject('user')->getId();
                $ticket->last_activity_by_name = $this->getObject('user')->getName();

                $document = $ticket->toArray();
                $document['id'] = md5($this->getObject('application')->getSite().'-'.$ticket->id);
                $document['zone'] = $entity->zone;

                foreach($document as $key => $value)
                {
                    if (substr($key, 0, 1) == '_') {
                        unset($document[$key]);
                    }
                }

                $context = $this->_getCommandContext($ticket);
                $context->document = $document;

                $this->getObject('com:elasticsearch.controller.document')
                    ->edit($context);
            }
        }

        // Make sure to include full user names for all fields that store a user id:
        $fields = array('created_by', 'modified_by', 'last_activity_by');
        foreach($fields as $field)
        {
            $id = $entity->$field;
            if (is_integer($id) && $id > 0)
            {
                $user = $this->getObject('com:users.database.table.users')->select($id, Library\Database::FETCH_ROW);
                $entity->{$field.'_name'} = $user->name;
            }
        }

        return parent::indexDocument($commandContext);
    }
}