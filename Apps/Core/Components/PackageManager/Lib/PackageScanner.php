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
            $this->_packages['apps'] = $this->_scanApps('Public/Apps');

            // scan Plugins folder
            $this->_packages['plugins'] = $this->_scanPlugins('Public/Plugins');

            // scan Themes folder
            $this->_packages['themes'] = $this->_scanThemes('Public/Themes');

            // store the packages in cache
            $this->_wCache()->save(self::CACHE_KEY, $this->_packages, (30 * 60));
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

    public function extractEvents($package = "")
    {
        foreach ($this->_packages['apps'] as $app) {
            die(print_r($app->getComponents()));
        }
    }

    public function getPackage($package)
    {
        return $this->_packages[$package]; //check if isset
    }

    private function _scanApps($appRoot)
    {
        return $this->__scan($appRoot, "App");
    }

    private function _scanPlugins($pluginsRoot)
    {
        return $this->__scan($pluginsRoot, "Plugin");
    }

    private function _scanThemes($themesRoot)
    {
        return $this->__scan($themesRoot, "Theme");
    }

    private function __scan($root, $object)
    {
        $packages = $this->_wStorage()->readDir($root);
        $result = [];
        foreach ($packages as $package) {
            // parse packageinfo
            $info = $this->_wConfig()->parseConfig($package->getKey() . '/' . $object . '.yaml');

            // create package instance
            $class = '\\WebinyPlatform\\Apps\\Core\\Components\\PackageManager\\Lib\\' . $object;
            $result[$package->getKey()] = new $class($info, $package->getKey());
        }

        return $result;
    }
}