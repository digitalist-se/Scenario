<?php
/**
 * Scenario, a plugin for Matomo.
 *
 * @link https://digitalist.se
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Scenario;

use Piwik\CronArchive;
use Piwik\Option;

/**
 * API for plugin Scenario
 *
 * @method static \Piwik\Plugins\Scenario\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    public function  getLatestCronRun(): string {
        $lastRunTime = (int)Option::get(CronArchive::OPTION_ARCHIVING_FINISHED_TS);
        return $lastRunTime;
    }

    public function calculateCron(): string {
        $result = $this->getLatestCronRun();
        $now = time();
        //$lastRunTimePretty = Date::factory($result)->getLocalized(DateTimeFormatProvider::DATETIME_FORMAT_LONG);
        $duration = $now-$result;
        $minutes = (int)($duration/60);
        return $minutes;
    }
}
