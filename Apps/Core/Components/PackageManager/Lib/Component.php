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
 */
class Component
{
    /**
     * @var string Component name.
     */
    private $_name;

    /**
     * @var string Path to the component (relative to application root).
     */
    private $_path;

    /**
     * @var ConfigObject Information about the component from Component yaml.
     */
    private $_info;

    /**
     * @var array An array of events to which the component is listening.
     */
    private $_events;


    public function __construct($name, $path, ConfigObject $info, array $events)
    {
        $this->_name = $name;
        $this->_path = $path;
        $this->_info = $info;
        $this->_events = $events;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function getInfo()
    {
        return $this->_info;
    }

    public function getEvents()
    {
        return $this->_events;
    }
}