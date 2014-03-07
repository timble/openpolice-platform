<?php
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class UploadsControllerUpload extends Library\ControllerModel
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback('after.add'  , array($this, 'forceRedirect'));
        $this->registerCallback('after.edit'  , array($this, 'forceRedirect'));
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array('editable')
        ));

        parent::_initialize($config);
    }

    public function forceRedirect(Library\CommandContext $context)
    {
        // @TODO: Find out why a form with enctype='multipart/form-data'
        // never sets the redirect back to the referrer.
        // For this reason, we force the redirect here:
        $context->response->setRedirect($context->request->getReferrer());
    }
}