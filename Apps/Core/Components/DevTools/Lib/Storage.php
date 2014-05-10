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

    static private $_appRootStorage;

    protected function _init()
    {
        $configPath = realpath(dirname(__FILE__) . '/../../../../../../') . '/';
        self::$_appRootStorage = new StorageProvider(new Local($configPath, ''));
    }

    public function appRoot($dir = '')
    {
        return new LocalDirectory($dir, self::$_appRootStorage);
    }
}