<?php
/**
 * @package     Koowa_Event
 * @subpackage 	Subscriber
 * @copyright   Copyright (C) 2007 - 2012 Johan Janssens. All rights reserved.
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

namespace Nooku\Library;

/**
 * Event Handler Interface
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Koowa_Event
 * @subpackage 	Subscriber
 */
interface EventSubscriberInterface
{
    /**
     * Get the priority of the subscriber
     *
     * @return	integer The event priority
     */
    public function getPriority();
          
    /**
     * Get a list of subscribed events 
     *       
     * Event handlers always start with 'on' and need to be public methods
     * 
     * @return array An array of public methods
     */
    public function getSubscriptions();
}