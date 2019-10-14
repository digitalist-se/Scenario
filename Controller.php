<?php
/**
 * Scenario, a plugin for Matomo.
 *
 * @link https://digitalist.se
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Scenario;


/**
 * Class Controller
 * @package Piwik\Plugins\Scenario
 */
class Controller extends \Piwik\Plugin\Controller
{
    public function index()
    {
        return $this->renderTemplate('@Scenario/index', [
            'foo' => 'bar',
        ]);
    }

}
