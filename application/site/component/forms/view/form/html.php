<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FormsViewFormHtml extends AboutViewHtml
{
    public function render()
    {
        //Get the article
        $form = $this->getModel()->getData();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($form->title, '');

        $this->fields = json_decode($form->fields);

        return parent::render();
    }
}
