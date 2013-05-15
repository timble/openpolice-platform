<?php
/**
 * @package     Koowa_Controller
 * @subpackage  Behavior
 * @copyright   Copyright (C) 2007 - 2012 Johan Janssens. All rights reserved.
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

namespace Nooku\Library;

/**
 * Lockable Controller Behavior Class
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Koowa_Controller
 * @subpackage  Behavior
 */
class ControllerBehaviorLockable extends ControllerBehaviorAbstract
{
    /**
     * Constructor
     *
     * @param ObjectConfig $config An optional ObjectConfig object with configuration options
     */
    public function __construct(ObjectConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback('after.read'  , array($this, 'lockEntity'));
        $this->registerCallback('after.save'  , array($this, 'unlockEntity'));
        $this->registerCallback('after.cancel', array($this, 'unlockEntity'));
    }

    /**
     * Lock callback
     *
     * Only lock if the context contains a row object and the view layout is 'form'.
     *
     * @param   CommandContext  $context The active command context
     * @return  void
     */
    public function lockEntity(CommandContext $context)
    {
        if ($context->result instanceof DatabaseRowInterface)
        {
            $view = $this->getView();

            if ($view instanceof ViewTemplate)
            {
                if($this->getModel()->getState()->isUnique() && $context->result->isLockable()) {
                    $context->result->lock();
                }
            }
        }
    }

    /**
     * Unlock callback
     *
     * @param  CommandContext  $context    The active command context
     * @return void
     */
    public function unlockEntity(CommandContext $context)
    {
        if ($context->result instanceof DatabaseRowInterface && $context->result->isLockable()) {
            $context->result->unlock();
        }
    }
}