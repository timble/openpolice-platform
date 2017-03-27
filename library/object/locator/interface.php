<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Object  Locator Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Object
 */
interface ObjectLocatorInterface
{
    /**
     * Get the locator type
     *
     * @return string
     */
    public function getType();

    /**
     * Get the locator fallbacks
     *
     * @return array
     */
    public function getFallbacks();

    /**
     * Returns a fully qualified class name for a given identifier.
     *
     * @param ObjectIdentifier $identifier An identifier object
     * @return string|false  Return the class name on success, returns FALSE on failure
     */
	public function locate(ObjectIdentifier $identifier);
}