<?php
/**
 * Belgian Police Web Platform - Analytics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AnalyticsViewAnalyticHtml extends Library\ViewHtml
{
    public function render()
    {
        require_once(JPATH_VENDOR . '/google-analytics-api-php/GoogleAnalyticsAPI.class.php'); // or wherever autoload.php is located

        $application = $this->getObject('application');
        $row = $this->getObject('com:analytics.database.row.analytic')
            ->set('analytics_analytic_id', '1')
            ->load();

        // Only generate a new AccessToken if it is expired
        if($row->expires_on < time())
        {
            $ga = new GoogleAnalyticsAPI('service');
            $ga->auth->setClientId($application->getCfg('google_auth_client')); // From the APIs console
            $ga->auth->setEmail($application->getCfg('google_auth_email')); // From the APIs console
            $ga->auth->setPrivateKey(JPATH_ROOT.'/config/key.p12'); // Path to the .p12 file

            $auth = $ga->auth->getAccessToken();

            // Try to get the AccessToken
            if ($auth['http_code'] == 200)
            {
                $row->token = $auth['access_token'];
                $row->expires_on = time() + $auth['expires_in'];
                $row->created = time();

                $row->save();
            } else {
                // error...
            }
        }

        $this->accessToken  = $row->token;
        $this->viewId       = 'ga:40087352';
        $this->site         = $this->getObject('application')->getSite();
        $this->filters      = 'ga:pagePath=~^\/'.$this->site.'(\/|$)';

        $now = new DateTime();
        $now->modify('-1 day');
        $this->end_date     = $now->format('D j M Y');
        $now->modify('-29 days');
        $this->start_date   = $now->format('D j M Y');

        return parent::render();
    }
}