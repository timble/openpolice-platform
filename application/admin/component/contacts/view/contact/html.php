<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

class ContactsViewContactHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $contact    = $model->getRow();

        if($contact->isLocatable() && $streets = $contact->getStreets())
        {
            if(count($streets) > 1)
            {
                $languages = $this->getObject('application.languages');
                $language = $languages->getActive()->slug;

                $streets = $streets->find(array('iso' => $language));
            }

            $this->street = $streets->top();
        }

        return parent::render();
    }
}