<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Debug;

use Nooku\Library;

/**
 * Application Event Subscriber
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Debug
 */
class EventSubscriberApplication extends Library\EventSubscriberAbstract
{
    public function __construct(Library\ObjectConfig $config)
	{
	    //Intercept the events for profiling
	    if($this->getObject('application')->getCfg('debug'))
	    {
	        //Replace the event dispatcher
	        $this->getObject('manager')->registerAlias('event.dispatcher', 'com:debug.event.profiler');
	          
	        //Add the database tracer
	        $this->getObject('application.database')->addEventSubscriber('com:debug.event.subscriber.database');
		}
		
		parent::__construct($config);
	}
}