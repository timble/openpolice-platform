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
 * Forbidden Http Exception
 *
 * The server refused to fulfill the request, for reasons other than invalid user credentials.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Http
 */
class HttpExceptionForbidden extends HttpExceptionAbstract
{
    protected $code = HttpResponse::FORBIDDEN;
}