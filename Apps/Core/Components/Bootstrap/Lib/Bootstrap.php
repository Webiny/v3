<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\Bootstrap\Lib;

use Webiny\Component\Storage\Storage;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * This class is included in the index.php and it responsible to bootstrap the application.
 */
class Bootstrap
{
    use SingletonTrait, DevToolsTrait;

    protected function _init()
    {
        // read configs
        $this->_buildConfiguration();

        // init cache

        // init database
    }

    private function _buildConfiguration()
    {
        // read the configuration
        $dir = $this->_wStorage()->appRoot("Public/Configs/Production")->filter("*.yaml");

        foreach($dir as &$file){
            $this->_wConfig()->appendConfig($file->getKey());
        }

    }

    private function _setEnvironment($environment)
    {

    }

}