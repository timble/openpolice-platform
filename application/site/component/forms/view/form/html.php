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

        if(isset($_COOKIE['forms_entry_id'])) {
            $this->entry = $this->getObject('com:forms.model.entries')->is_valid('0')->id($_COOKIE['forms_entry_id'])->getRow();

            $this->entry->text      = json_decode($this->entry->text);
            $this->entry->validation    = json_decode($this->entry->validation);

            // Add name and email to text to simplify the template helper
            $this->entry->text->name    = $this->entry->name;
            $this->entry->text->email   = $this->entry->email;
        } else {
            $this->entry = false;
        }

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($form->title, '');

        $this->fields = json_decode($form->fields);

        return parent::render();
    }
}
