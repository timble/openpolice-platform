<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Languages;

use Nooku\Library;

/**
 * Iso Code Filter
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Languages
 */
class FilterIso extends Library\FilterCmd
{
    public function validate($value)
    {
        $value = trim($value);
        $pattern = '#^[a-z]{2,3}\-[a-z]{2,3}$#i';
        
        return (is_string($value) && (preg_match($pattern, $value)) == 1);
    }

    public function sanitize($value)
    {
        $value = trim($value);
        $pattern  = '#[^a-z\-]*#i';
        
        return preg_replace($pattern, '', $value);
    }
}