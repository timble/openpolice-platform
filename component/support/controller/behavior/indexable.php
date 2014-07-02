<?php
namespace Nooku\Component\Support;

use Nooku\Library;
use Nooku\Component\Elasticsearch;

class ControllerBehaviorIndexable extends Elasticsearch\ControllerBehaviorIndexable
{
    public function indexDocument(Library\CommandContext $commandContext)
    {
        $entity = $commandContext->result;
        $entity->zone = !empty($commandContext->request->data->site) ? $commandContext->request->data->site : $this->getObject('application')->getSite();

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
            $entity->parent = md5($entity->zone . '-' . $entity->row);

            if ($entity->getStatus() == Library\Database::STATUS_CREATED)
            {
                $id     = $entity->get('row', 'int');
                $ticket = $this->getObject('com:support.database.table.tickets')->select($id, Library\Database::FETCH_ROW);

                $ticket->last_activity_on = gmdate('Y-m-d H:i:s');
                $ticket->last_activity_by = (int) $this->getObject('user')->getId();

                $this->_includeFullNames($ticket);

                $document = $ticket->toArray();
                $document['support_ticket_id'] = $ticket->id;
                $document['id'] = md5($entity->zone.'-'.$ticket->id);
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
        $this->_includeFullNames($entity);

        return parent::indexDocument($commandContext);
    }

    protected function _includeFullNames($row)
    {
        $fields = array('created_by', 'modified_by', 'last_activity_by');
        foreach($fields as $field)
        {
            $id         = (int) $row->$field;
            $field_name = $field.'_name';

            if ($id > 0 && empty($row->$field_name))
            {
                $user = $this->getObject('com:users.database.table.users')->select($id, Library\Database::FETCH_ROW);

                if (!$user->isNew()) {
                    $row->$field_name = $user->name;
                }
            }
        }
    }
}