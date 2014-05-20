<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\Cache\CacheStorage;
use Webiny\Component\StdLib\SingletonTrait;


/**
 * Class that provides the access to caching system.
 */
class Cache
{
    use SingletonTrait;

    /**
     * @var CacheStorage
     */
    static private $_cache;

    /**
     * Initialize the cache.
     *
     * @throws \Exception
     */
    protected function _init()
    {
        $cacheDriver = Config::getInstance()->getConfig()->get("Cache.Driver", "Null");
        $cacheParams = Config::getInstance()->getConfig()->get("Cache.Arguments", [], true);

        try {
            self::$_cache = call_user_func_array([
                                                     '\Webiny\Component\Cache\Cache',
                                                     $cacheDriver
                                                 ], $cacheParams
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get cache storage instance.
     *
     * @return CacheStorage
     */
    public function getCache()
    {
        return self::$_cache;
    }
}