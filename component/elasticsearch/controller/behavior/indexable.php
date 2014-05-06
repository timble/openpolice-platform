<?php
namespace Nooku\Component\Elasticsearch;

use Nooku\Library;

class ControllerBehaviorIndexable extends Library\ControllerBehaviorAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback('after.add' , array($this, 'indexDocument'));
        $this->registerCallback('after.edit' , array($this, 'indexDocument'));
    }

    public function indexDocument(Library\CommandContext $commandContext)
    {
        $entity = $commandContext->result;

        if ($entity->getStatus() == Library\Database::STATUS_CREATED || $entity->getStatus() == Library\Database::STATUS_UPDATED)
        {
            $document = $entity->toArray();

            foreach($document as $key => $value)
            {
                if (substr($key, 0, 1) == '_') {
                    unset($document[$key]);
                }
            }

            $context = $this->_getCommandContext($entity);
            $context->document = $document;

            $this->getObject('com:elasticsearch.controller.document')
                    ->add($context);
        }
    }

    protected function _afterControllerDelete(Library\CommandContext $commandContext)
    {
        $entity = $commandContext->result;

        if ($entity->getStatus() == Library\Database::STATUS_DELETED)
        {
            $context = $this->_getCommandContext($entity);
            $context->id = $entity->id;

            $this->getObject('com:elasticsearch.controller.document')
                    ->delete($context);
        }
    }

    protected function _getCommandContext($entity)
    {
        $context = new Library\CommandContext();
        $context->setSubject($this->getMixer());

        $context->index    = $entity->getIdentifier()->package;
        $context->type     = $entity->getIdentifier()->name;

        return $context;
    }
}