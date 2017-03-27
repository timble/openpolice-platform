<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Files;

use Nooku\Library;

/**
 * Resizable Command
 *
 * If the container has a parameter named "maximum_image_size", image will be resized so that no dimension is larger than maximum_image_size
 *
 * @author  Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package Nooku\Component\Files
 */
class CommandResizable extends Library\Command
{
    /**
     * Makes the command high priority so it kicks in before thumbnailable
     *
     * {@inheritdoc}
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'priority' => self::PRIORITY_HIGH,
        ));

        parent::_initialize($config);
    }

    protected function _databaseAfterSave(Library\CommandContext $context)
    {
        $row = $context->getSubject();
        $max = $row->getContainer()->parameters->maximum_image_size;

        if ($row->isImage() && $max)
        {
            try
            {
                $imagine = new \Imagine\Gd\Imagine();
                $image   = $imagine->open($row->fullpath);
                $size    = $image->getSize();
                $larger  = max($size->getWidth(), $size->getHeight());

                if ($larger > $max) {
                    $image->resize($size->scale($max/$larger));
                    $image->save($row->fullpath);
                }
            }
            catch (\Exception $e) {
            }
        }

    }
}