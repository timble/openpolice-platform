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
 * Controller Toolbar Command Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Controller
 */
interface ControllerToolbarCommandInterface extends ControllerToolbarInterface
{
    /**
     * Constructor.
     *
     * @param	string $name The command name
     * @param   array|ObjectConfig 	An associative array of configuration settings or a ObjectConfig instance.
     */
    public function __construct( $name, $config = array());

    /**
     * Get the parent command
     *
     * @return	ControllerToolbarCommandInterface
     */
    public function getParent();

    /**
     * Set the parent command
     *
     * @param ControllerToolbarCommandInterface $command The parent command
     * @return ControllerToolbarCommandInterface
     */
    public function setParent(ControllerToolbarCommandInterface $command );

    /**
     * Get the toolbar object
     *
     * @return ControllerToolbarInterface
     */
    public function getToolbar();

    /**
     * Set the parent node
     *
     * @param object $node The toolbar this command belongs too
     * @return ControllerToolbarCommand
     */
    public function setToolbar(ControllerToolbarInterface $toolbar );
}