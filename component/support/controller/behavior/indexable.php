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
            } else {
                $entity->last_activity_on = $entity->modified_on;
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

                $document = $ticket->toArray();
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

        return parent::indexDocument($commandContext);
    }

}