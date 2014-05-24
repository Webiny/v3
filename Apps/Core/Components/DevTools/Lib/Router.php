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
 * Router class.
 *
 * This class holds all the registered routes and provides methods for matching and generating urls.
 *
 */
class Router
{
    use SingletonTrait;

    /**
     * @var \Webiny\Component\Router\Router
     */
    private $_router;

    /**
     * @var ConfigObject
     */
    private $_routes;


    /**
     * Basic router constructor.
     */
    protected function _init()
    {
        $this->_router = new \Webiny\Component\Router\Router();
        $this->_router->setCache(Cache::getInstance()->getCache());

        $this->_routes = new ConfigObject([]);
    }

    /**
     * Register routes.
     *
     * @param ConfigObject $routes A ConfigObject instance with list of routes and route details.
     */
    public function registerRoutes(ConfigObject $routes)
    {
        $this->_routes->mergeWith($routes);
    }

    /**
     * Returns the internal object holding all the routes.
     *
     * @return ConfigObject
     */
    public function getRoutes()
    {
        return $this->_routes;
    }

    /**
     * Sets the internal object that holds all the routes.
     * Do not use this function, it is used to populate the routes from the cache.
     *
     * @param ConfigObject $routes
     */
    public function setRoutes(ConfigObject $routes)
    {
        $this->_routes = $routes;
    }

    /**
     * This method is called when all routes are registered.
     * It is called automatically, no need to call it again.
     */
    public function compileRoutes()
    {
        // compile routes
        $this->_router->setRoutes($this->_routes);
    }

    /**
     * Checks is some of the registered routes matches the given url.
     *
     * @param string $url Url.
     *
     * @return array|bool Returns either the matched route or false.
     */
    public function match($url)
    {
        return $this->_router->match($url);
    }

    /**
     * Generate a url from a route.
     *
     * @param string $name       Name of the Route.
     * @param array  $parameters List of parameters that need to be replaced within the Route path.
     * @param bool   $absolute   Do you want to get the absolute url or relative. Default is absolute.
     *
     * @return string Generated url.
     */
    public function generate($name, $parameters = [], $absolute = true)
    {
        return $this->_router->generate($name, $parameters, $absolute);
    }
}
