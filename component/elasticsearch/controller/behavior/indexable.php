<?php
/**
 * Belgian Police Web Platform - Elasticsearch Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

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
            $document['id'] = md5($this->getObject('application')->getSite().'-'.$entity->id);

            if ($entity->getTable() instanceof Library\DatabaseTableAbstract)
            {
                if ($identity_column = $entity->getTable()->getIdentityColumn()) {
                    $document[$identity_column] = $entity->id;
                }
            }

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
            $context->id = md5($this->getObject('application')->getSite().'-'.$entity->id);

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
