<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\PackageManager\Lib;

use Webiny\Component\Config\ConfigObject;

/**
 * Contains information about the component.
 * Components must always reside inside an App.
 */
class Component
{
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
     * @var ConfigObject Additional information about the component from Component.yaml.
     */
    private $_info;

    /**
     * @var array An array of events to which the component is listening.
     */
    private $_events;


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
        $this->_info = $info;

        $this->_name = $info->get('name', '');
        $this->_version = $info->get('version', '');

        if ($this->_name == '' || $this->_version == '') {
            throw new \Exception("A component must have both name and version properties defined.");
        }
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
    public function getVersion(){
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
     * @return ConfigObject
     */
    public function getInfo()
    {
        return $this->_info;
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
}