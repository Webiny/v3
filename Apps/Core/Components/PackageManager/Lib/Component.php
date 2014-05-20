<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\PackageManager\Lib;

use Webiny\Component\Config\ConfigObject;
use Webiny\Component\Router\Router;
use Webiny\Component\StdLib\StdObjectTrait;

/**
 * Contains information about the component.
 * Components must always reside inside an App.
 */
class Component
{
    use StdObjectTrait;

    /**
     * @var string Component name.
     */
    private $_name;

    /**
     * @var string Component version.
     */
    private $_version;

    /**
     * @var string Path to the component (relative to application root).
     */
    private $_path;

    /**
     * @var string Namespace under which this components is placed.
     */
    private $_namespace;

    /**
     * @var array An array of events to which the component is listening.
     */
    private $_events = [];


    /**
     * @var array An array of registered routes.
     */
    private $_routes = [];

    /**
     * Component base constructor.
     *
     * @param ConfigObject $info Component info.
     * @param string       $path Path to the component.
     *
     * @throws \Exception
     */
    public function __construct(ConfigObject $info, $path)
    {
        $this->_path = $path;
        $this->_namespace = $this->str($path)->replace([
                                                           'Public',
                                                           DIRECTORY_SEPARATOR
                                                       ], [
                                                           '\\WebinyPlatform',
                                                           '\\'
                                                       ]
        )->val();

        $this->_name = $info->get('Name', '');
        $this->_version = $info->get('Version', '');

        if ($this->_name == '' || $this->_version == '') {
            throw new \Exception("A component must have both name and version properties defined.");
        }

        $this->_parseEvents($info);
        $this->_parseRoutes($info);
    }

    /**
     * Get component name.
     *
     * @return string Component name.
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get component version.
     *
     * @return string Component version.
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Get path to the component.
     *
     * @return string Component path.
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->_info->get('Events', []);
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->_info->get('Routes', []);
    }

    /**
     * Parses the events attached to the component.
     *
     * @param ConfigObject $info Parsed Component.yaml ConfigObject.
     */
    private function _parseEvents($info)
    {
        $eventConfig = $info->get('Events', [], true);
        if (count($eventConfig) > 0) {
            foreach ($eventConfig as $eventGroupName => $eventGroups) {
                $eventName = $eventGroupName;
                foreach ($eventGroups as $subGroupName => $subGroupEvents) {
                    $eventName .= '.' . $subGroupName;
                    foreach ($subGroupEvents as $eName => $callback) {
                        $eventName .= '.' . $eName;

                        $callback = $this->str($callback)->replace('/', '\\');

                        if ($callback->startsWith('\\')) {
                            $this->_events[$eventName] = $callback->val();
                        } else {
                            $this->_events[$eventName] = $this->_namespace . '\\' . $callback->val();
                        }
                    }
                }
            }
        }
    }

    private function _parseRoutes($info)
    {
        $routes = $info->get('Routes', false);
        if($routes){
            $this->_routes = new Router($routes);
        }
    }
}