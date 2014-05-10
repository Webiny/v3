<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\StdLib\SingletonTrait;

/**
 * Provides us with access to class loader.
 */
class ClassLoader
{
    use SingletonTrait;

    /**
     * @var \Webiny\Component\ClassLoader\ClassLoader
     */
    static private $_classLoader;

    protected function _init()
    {
        self::$_classLoader = \Webiny\Component\ClassLoader\ClassLoader::getInstance();
    }

    public function appendLibrary($namespace, $path)
    {
        self::$_classLoader->registerMap([$namespace => $path]);
    }
}
