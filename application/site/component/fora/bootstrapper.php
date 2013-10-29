<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Bootstrapper
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaBootstrapper extends Library\BootstrapperAbstract
{
    /**
     * Bootstrap the component
     *
     * @return void
     */
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:fora.model.categories', 'com:categories.model.categories');
        $manager->registerAlias('com:fora.model.comments', 'com:comments.model.comments');
    }
}