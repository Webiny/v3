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
 * Holds information about the defined package.
 */
class Package
{
    /**
     * @var string Name of the package.
     */
    private $_name;

    private $_version;

    private $_link;

    private $_description;

    private $_authorName;

    private $_authorLink;

    private $_authorEmail;

    /**
     * @var string Path to the package (relative to application root).
     */
    private $_path;

    /**
     * @var string Can be 'app' or 'plugin'.
     */
    private $_type;

    /**
     * @var array An array of Component instances.
     */
    private $_components = [];


    public function __construct(ConfigObject $info, $path, $type, array $components)
    {
        $this->_populateProperties($info);
        if ($type != "app" && $type != "plugin") {
            throw new \Exception("Invalid package type: " . $type);
        }
        $this->_type = $type;

        $this->_components = $components;
        $this->_info = $info;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function getVersion(){
        return $this->_version;
    }

    public function getDescription(){
        return $this->_description;
    }

    public function getAuthorName(){
        return $this->_authorName;
    }

    public function getAuthorLink(){
        return $this->_authorLink;
    }

    public function getAuthorEmail(){
        return $this->_authorEmail;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function isApp()
    {
        return ($this->_type == "app");
    }

    public function isPlugin()
    {
        return !$this->isApp();
    }

    public function getComponents()
    {
        return $this->_components;
    }

    private function _populateProperties(ConfigObject $properties)
    {
        $properties = get_object_vars($this);
        foreach ($properties as $p) {
            $pName = substr($p, 1);
            $this->$p = $properties->$pName;
        }
    }
}