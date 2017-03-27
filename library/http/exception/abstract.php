<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Abstract Http Exception
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Http
 */
abstract class HttpExceptionAbstract extends \RuntimeException implements HttpException
{
    /**
     * Constructor
     *
     * @param string  $message  The exception message
     * @param object  $previous The previous exception
     */
    public function __construct($message = null, \Exception $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }
}