<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class ContactsViewHoursHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the hours
        $hours = $this->getModel()->getData();

        $this->query = $this->getObject("request")->query;

        $this->date = !empty($this->query->date) ? new DateTime($this->query->date) : new DateTime('NOW');
        $this->today = new DateTime('NOW');

        $tomorrow = new DateTime('NOW');
        $this->tomorrow = $tomorrow->modify('+1 day');

        // Build pagination
        if(count($hours))
        {
            $arguments = array('number' => $this->query->number, 'street' => $this->query->street);
            $url = $this->getObject('http.url')->setQuery($arguments);
            $arguments = array_filter($url->getQuery(true));

            $next = new DateTime('NOW');
            $next->modify('+7 days');

            $arguments['date'] = empty($this->query->date) ? $next->format('Y-m-d') : '';
            $url->setQuery($arguments);

            $this->pagination = (string) $url;
        }

        return parent::render();
    }
}