<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\Bootstrap\Lib;

use Webiny\Component\StdLib\StdObjectTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * This class is included in the index.php and it responsible to bootstrap the application.
 */
class Bootstrap
{
    use SingletonTrait, DevToolsTrait, StdObjectTrait;

    protected function _init()
    {
        // read production configs
        $this->_buildConfiguration("Production");

        // get additional config set
        $configSet = $this->_getConfigSet();
        if($configSet){
            $this->_buildConfiguration($configSet);
        }

        // set the environment
        $this->_setEnvironment($this->_wConfig()->get("Application.Environment", "production"));

        // scan all components to get registered subscribers


        // fire event
    }

    private function _buildConfiguration($configSet)
    {
        try{
            // get the configuration files
            $dir = $this->_wStorage()->readDir("Public/Configs/" . $configSet)->filter("*.yaml");

            // insert them into the global configuration object
            foreach ($dir as &$file) {
                $this->_wConfig()->appendConfig($file->getKey());
            }

            // append config sets
            $this->_wConfig()->appendConfig("Public/Configs/ConfigSets.yaml");
        }catch (\Exception $e){
            throw new \Exception("Unable to build config set ".$configSet.". ".$e->getMessage());
        }
    }

    private function _getConfigSet()
    {
        $configSets = $this->_wConfig()->get("ConfigSets", []);
        $currentDomain = $this->str($this->_wRequest()->getCurrentUrl(true)->getDomain())->caseLower()->trimRight('/')
                              ->val();

        $configSet = false;
        foreach ($configSets as $name => $domain) {
            if ($currentDomain == $this->str($domain)->caseLower()->trimRight('/')) {
                $configSet = $name;
            }
        }

        return $configSet;
    }

    private function _setEnvironment($environment)
    {
        if ($environment == "development") {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
        }
    }

}