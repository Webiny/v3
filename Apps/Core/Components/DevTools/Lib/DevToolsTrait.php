<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\Cache\CacheStorage;

/**
 * This trait provides you with access to all core components.
 */
trait DevToolsTrait
{

    /**
     * Get access to database.
     *
     * @return Database
     */
    static protected function _wDatabase()
    {
    }

    /**
     * Get access to storage.
     *
     * @return Storage
     */
    static protected function _wStorage()
    {
        return Storage::getInstance();
    }

    /**
     * Get access to class loader.
     *
     * @return ClassLoader
     */
    static protected function _wClassLoader()
    {
        return ClassLoader::getInstance();
    }

    /**
     * Get access to caching system.
     *
     * @return CacheStorage
     */
    static protected function _wCache()
    {
        return Cache::getInstance()->getCache();
    }

    /**
     * Get access to system configuration.
     *
     * @return Config
     */
    static protected function _wConfig()
    {
        return Config::getInstance();
    }

    /**
     * Get current request information.
     *
     * @return \Webiny\Component\Http\Request
     */
    static protected function _wRequest()
    {
        return Request::getInstance()->getRequest();
    }

    /**
     * Get access to event manager.
     *
     * @return Events
     */
    static protected function _wEvents()
    {
    }

    /**
     * @TODO This should return a class that the user should use to build an output for REST requests
     */
    static protected function _wServiceOutput()
    {
    }

    /**
     * @TODO This should return a class that we can use to contact REST services directly from within PHP
     */
    static protected function _wService()
    {
    }

    /**
     * @TODO This should return an instance of EntityAbstract, or some entity in particular.
     */
    static protected function _wEntity($entity)
    {
    }

    /**
     * @TODO This should return an instance of template engine...
     */
    static protected function _wTemplateEngine()
    {
    }
}
