<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Date Template Helper
 *
 * @author  Arunas Mazeika <http://nooku.assembla.com/profile/arunasmazeika>
 * @package Component\Articles
 */
class ArticlesTemplateHelperDate extends Library\TemplateHelperDate
{
    public function timestamp($config = array())
    {
        $config = new Library\ObjectConfig($config);

        $config->append(array('parameters' => $this->getObject('application.extensions')->articles->params))
               ->append(array(
                    'show_create_date' => $config->parameters->get('show_create_date', false),
                    'show_modify_date' => $config->parameters->get('show_modify_date', false)
                ));

        $article = $config->row;

        $html = array();

        if ($config->show_create_date) {
            $html[] = '<span class="text--small">';
            $html[] = $this->format(array('date'=> $article->ordering_date, 'format' => $this->translate('DATE_FORMAT_LC5')));
        }

        if ($config->get('show_modify_date') && $config->show_create_date && ($modified_on = $article->modified_on) && (intval($modified_on) != 0))
        {
            $html[] = JText::sprintf('LAST_UPDATED2',
                $this->format(array('date' => $article->modified_on, 'format' => $this->translate('DATE_FORMAT_LC5'))));
        }
        
        if ($config->show_create_date) {
            $html[] = '</span>';
        }

        return implode(' ', $html);
    }
}