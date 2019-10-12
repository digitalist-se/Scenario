<?php
/**
 * Scenario, a plugin for Matomo.
 *
 * @link https://digitalist.se
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
declare(strict_types = 1);
namespace Piwik\Plugins\Scenario;

use Piwik\Plugins\Courier\API as CourierAPI;

/**
 * Class Tasks
 * @package Piwik\Plugins\Scenario
 */

class Tasks extends \Piwik\Plugin\Tasks
{
    /*
     * @return function
     */
    final function schedule(): \Piwik\Scheduler\Schedule\Schedule
    {
        // @todo move all hard coded values to the UI, and build scenarios there.
       return $this->hourly('checkCron', "80###", self::HIGH_PRIORITY);
    }


    final function checkCron (string $param): API
    {
        /* @todo - all hardcoded values should come from the UI - $param is a beast - could only be a string,
         * so we need to explode that string, like: $param1###$param2###$param3
         */

        //list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $param);
        $api = new API();
        $check = $api->calculateCron();
        if ($check  >= 60) {
            $courier = new CourierAPI();
            $result = $courier->sendWebhook(3,"Cron ran for $check minutes ago $param",'internal');
        }

    }
}
