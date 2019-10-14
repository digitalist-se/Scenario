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
       return $this->hourly('checkCoreArchive', "1", self::HIGH_PRIORITY);
    }


    final function checkCoreArchive (string $minutes): void
    {
        /* @todo - all hardcoded values should come from the UI - $param is a beast - could only be a string,
         * so we need to explode that string, like: $param1###$param2###$param3, like:
         * list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode("###", $param);
         */
        $api = new API();
        $check = $api->calculateCron();
        if ($check  >= $minutes) {
            $courier = new CourierAPI();
            $result = $courier->sendWebhook(3,"Core archive ran for *$check* minutes ago",'internal');
        }

    }
}
