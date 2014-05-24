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
 * Description
 */
class Plugin extends PackageAbstract
{
    use ParsersTrait;

    /**
     * Plugin base constructor.
     *
     * @param ConfigObject $info Plugin information.
     * @param string       $path Absolute path to the plugin.
     */
    public function __construct(ConfigObject $info, $path)
    {
        parent::__construct($info, $path, "plugin");

        $this->_parseNamespace($path);
        $this->_parseEvents($info);
        $this->_parseRoutes($info);
    }

}