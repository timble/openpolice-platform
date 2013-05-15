<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class PoliceModuleTelephoneHtml extends PagesModuleDefaultHtml
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'model' => 'com:contacts.model.contacts',
        ));

        parent::_initialize($config);
    }

    public function render()
    {
        $this->params = $this->module->params;

        $this->getModel()->id($this->params->get('contacts_contact_id'));
        return parent::render();
    }
}