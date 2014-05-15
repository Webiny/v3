<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\Config\ConfigObject;
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
    static private $_configReader;

    /**
     * @var ConfigObject
     */
    static private $_config;

    /**
     * Initialize the Config
     */
    protected function _init()
    {
        // before we can use the Config reader, we need to insert the Symfony YAML parse into ClassLoader
        ClassLoader::getInstance()->appendLibrary("Symfony", Storage::getInstance()->getPath('Vendors/Symfony'));

        // create config reader instance
        self::$_configReader = \Webiny\Component\Config\Config::getInstance();

        // create initial config instance
        self::$_config = new ConfigObject([]);
    }

    /**
     * Append a configuration file. Must be in YAML format.
     *
     * @param string $resource Path to the config, should be relative to app root.
     */
    public function appendConfig($resource)
    {
        self::$_config->mergeWith(self::$_configReader->yaml(Storage::getInstance()->getPath($resource)));
    }

    /**
     * Returns the value for the given config name. The name can have a dot, which defines depth levels.
     *
     * @param string $name
     * @param null   $default
     *
     * @return mixed|ConfigObject
     */
    public function get($name, $default = null)
    {
        return self::$_config->get($name, $default);
    }

    public function getConfig(){
        return self::$_config;
    }

    /**
     * Magic get method, so you don't need to use the defined get method.
     *
     * @param $name
     *
     * @return mixed|ConfigObject
     */
    public function __get($name)
    {
        return $this->get($name);
    }

}