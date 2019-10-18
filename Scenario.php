<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Scenario;

use Piwik\Plugins\Courier\API as CourierAPI;

class Scenario extends \Piwik\Plugin
{
    public function registerEvents()
    {
        return array(
            'CronArchive.archiveSingleSite.start' => 'archiveStart',
            'Scenario.checkCoreArchive.end' => 'archiveStart'
        );
    }

    public function archiveStart($idSite)
    {
        /* @todo - all hardcoded values should come from the UI - $param is a beast - could only be a string,
         * so we need to explode that string, like: $param1###$param2###$param3, like:
         * list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode("###", $param);
         */
        $courier = new CourierAPI();
        $result = $courier->sendWebhook(1,"Archiving started for site $idSite",'internal');
    }

}
