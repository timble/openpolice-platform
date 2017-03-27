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
 * Bead Request Http Exception
 *
 * The request itself or the data supplied along with the request is invalid and could not be processed by the server.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Http
 */
class HttpExceptionBadRequest extends HttpExceptionAbstract
{
    protected $code = HttpResponse::BAD_REQUEST;
}