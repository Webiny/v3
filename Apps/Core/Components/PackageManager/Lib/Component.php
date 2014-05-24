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
    use ParsersTrait;

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

        $this->_name = $info->get('Name', '');
        $this->_version = $info->get('Version', '');

        if ($this->_name == '' || $this->_version == '') {
            throw new \Exception("A component must have both name and version properties defined.");
        }

        $this->_parseNamespace($path);
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
}