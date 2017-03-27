<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Typable Database Behavior Interface
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Pages
 */
interface DatabaseBehaviorTypeInterface
{
    public function getTypeTitle();

    public function getTypeDescription();

    public function getParams($group);

    public function getLink();
}