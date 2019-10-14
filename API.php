<?php
/**
 * Scenario, a plugin for Matomo.
 *
 * @link https://digitalist.se
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Scenario;

use Piwik\CronArchive;
use Piwik\NoAccessException;
use Piwik\Option;
use Piwik\Piwik;

/**
 * API for plugin Scenario
 *
 * @method static \Piwik\Plugins\Scenario\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    final function  getLatestCronRun(): string {

        try {
            Piwik::checkUserIsNotAnonymous();
        } catch (NoAccessException $e) {
        }
        $lastRunTime = (int)Option::get(CronArchive::OPTION_ARCHIVING_FINISHED_TS);
        return $lastRunTime;
    }

    final function calculateCron(): string {
        try {
            Piwik::checkUserIsNotAnonymous();
        } catch (NoAccessException $e) {
        }
        $result = $this->getLatestCronRun();
        $now = time();
        $duration = $now-$result;
        $minutes = (int)($duration/60);
        return $minutes;
    }
}
