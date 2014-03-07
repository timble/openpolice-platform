<?php
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class UploadsBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $this->getClassLoader()
            ->getLocator('psr')
            ->registerNamespace('Sunra\PhpSimple', JPATH_VENDOR.'/sunra/php-simple-html-dom-parser/Src');
    }
}
