<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\Storage\Directory\LocalDirectory;
use Webiny\Component\Storage\Driver\Local\Local;
use Webiny\Component\Storage\Storage as StorageProvider;

/**
 * Storage class provides us with access to the storage.
 */
class Storage
{
    use SingletonTrait;

    /**
     * @var StorageProvider
     */
    static private $_appRootStorage;

    /**
     * Initializes the storage
     */
    protected function _init()
    {
        // get app absolute path
        $configPath = realpath(dirname(__FILE__) . '/../../../../../../') . '/';

        // init StorageProvider
        self::$_appRootStorage = new StorageProvider(new Local($configPath, ''));
    }

    /**
     * Read the defined directory
     *
     * @param string $dir Path from application root.
     *
     * @return LocalDirectory
     */
    public function readDir($dir = '')
    {
        return new LocalDirectory($dir, self::$_appRootStorage);
    }

    /**
     * Get absolute path based from application root
     *
     * @param string $path Path from application root.
     *
     * @return string
     */
    public function getPath($path)
    {
        return self::$_appRootStorage->getAbsolutePath($path);
    }
}