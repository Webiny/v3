<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\PackageManager\Lib;

use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\StdLib\StdLibTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;

/**
 * PackageScanner scans the current installation and lists information about all installed apps and plugins.
 */
class PackageScanner
{
    use DevToolsTrait, SingletonTrait, StdLibTrait;

    const CACHE_KEY = 'Core.PackageManager.PackageScanner.Packages';

    /**
     * @var array An array containing a list of Package instances.
     */
    private $_packages = [];

    protected function _init()
    {
        // see if we have already all the packages in cache
        $data = $this->_wCache()->read(self::CACHE_KEY);
        if ($data) {
            $this->_packages = $this->unserialize($data);
        } else {
            // scan Apps folder
            $this->_scanApplications('Public/Apps');

        }
    }

    static function clearCacheCallback($event)
    {
        self::_wCache()->delete(self::CACHE_KEY);
    }

    public function listPackages()
    {
        return $this->_packages;
    }

    public function getPackage($package)
    {
        return $this->_packages[$package]; //check if isset
    }

    private function _scanApplications($applicationsRoot)
    {
        $apps = $this->_wStorage()->readDir($applicationsRoot);
        foreach ($apps as $app) {
            // parse app info
            $info = $this->_wConfig()->parseConfig($app->getKey().'/App.yaml');

            // scan the app for components
            $components = $this->_wStorage()->readDir($app->getKey() . "/Components/");
            foreach ($components as $component) {

            }
        }
    }

    private function _scanPlugins($pluginsRoot)
    {

    }
}