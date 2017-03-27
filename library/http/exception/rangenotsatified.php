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
 * Method Not Allowed Http Exception
 *
 * The request is out of bounds—that, none of the range values overlap the extent of the resource.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Http
 * @see http://tools.ietf.org/html/rfc2616#section-10.4.17
 */
class HttpExceptionRangeNotSatisfied extends HttpExceptionAbstract
{
    protected $code = HttpResponse::REQUESTED_RANGE_NOT_SATISFIED;
}