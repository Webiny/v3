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
abstract class PackageAbstract
{
    /**
     * @var string Name of the package.
     */
    private $_name;

    /**
     * @var string Package version.
     */
    private $_version;

    /**
     * @var string Link to the package on Webiny Store.
     */
    private $_link;

    /**
     * @var string Package description.
     */
    private $_description;

    /**
     * @var string Author name.
     */
    private $_authorName;

    /**
     * @var string Link to authors website.
     */
    private $_authorLink;

    /**
     * @var string Authors email.
     */
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
     * Base constructor.
     *
     * @param ConfigObject $info Package information.
     * @param string       $path Path to the package (relative to app root).
     * @param string       $type Can be app, plugin or theme.
     *
     * @throws \Exception
     */
    public function __construct(ConfigObject $info, $path, $type)
    {
        $this->_populateProperties($info);
        if (!in_array($type, [
                               'app',
                               'plugin',
                               'theme'
                           ]
        )
        ) {
            throw new \Exception("Invalid package type: " . $type);
        }
        $this->_type = $type;
        $this->_path = $path;
    }

    /**
     * Get app name.
     * @return string App name.
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get link to the package on Webiny Store.
     *
     * @return string Url
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * Version number.
     *
     * @return string Version number.
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Short package description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Author name.
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->_authorName;
    }

    /**
     * Get the link to the author website.
     *
     * @return string
     */
    public function getAuthorLink()
    {
        return $this->_authorLink;
    }

    /**
     * Get author email.
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->_authorEmail;
    }

    /**
     * Get the path to the component. Path is relative to the app root.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Check if current parent object is an app.
     *
     * @return bool
     */
    public function isApp()
    {
        return ($this->_type == "app");
    }

    /**
     * Check if current parent object is a plugin.
     *
     * @return bool
     */
    public function isPlugin()
    {
        return ($this->_type == "plugin");
    }

    /**
     * Check if current parent object is a plugin.
     *
     * @return bool
     */
    public function isTheme()
    {
        return ($this->_type == "theme");
    }

    /**
     * Populates object properties from the provided ConfigObject.
     *
     * @param ConfigObject $data Object from which to thake the properties.
     */
    private function _populateProperties(ConfigObject $data)
    {
        $properties = get_object_vars($this);

        foreach ($properties as $k => $v) {
            $pName = substr($k, 1);
            if (property_exists($this, $k)) {
                $this->$k = $data->get($pName, "");
            }
        }
    }
}