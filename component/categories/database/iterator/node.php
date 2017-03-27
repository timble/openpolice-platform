<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Categories;

use Nooku\Library;

/**
 * Recursive Node Iterator
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Files
 */
class DatabaseIteratorNode extends \RecursiveIteratorIterator
{
    public function __construct(DatabaseRowsetNodes $nodes, $mode = \RecursiveIteratorIterator::SELF_FIRST, $flags = 0)
    {
        parent::__construct($nodes, $mode, $flags);
    }

    public function callGetChildren()
    {
        return $this->current()->getChildren()->getIterator();
    }

    public function callHasChildren()
    {
        return $this->current()->hasChildren();
    }
}


