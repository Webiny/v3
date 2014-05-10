<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\StdLib\SingletonTrait;

/**
 * Class that holds the system configuration.
 */
class Config
{
    use SingletonTrait;

    /**
     * @var \Webiny\Component\Config\Config
     */
    static private $_config;

    protected function _init()
    {

        die(Storage::getInstance()->appRoot('Vendors/Symfony')->getKey()); //@todo ovaj dio nešto zajebava
        ClassLoader::getInstance()->appendLibrary("Symfony", Storage::getInstance()->appRoot('Vendors/Symfony')->getKey());
        self::$_config = \Webiny\Component\Config\Config::getInstance();
    }

    public function appendConfig($resource)
    {
        self::$_config->yaml($resource);
    }

    public function getConfig()
    {
        return self::$_config;
    }
}