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
 * Provides you with access to an object containing the data about current request
 */
class Request
{
    use SingletonTrait;

    /**
     * @var \Webiny\Component\Http\Request
     */
    static private $_request;

    protected function _init()
    {
        self::$_request = \Webiny\Component\Http\Request::getInstance();
    }

    /**
     * @return \Webiny\Component\Http\Request
     */
    public function getRequest()
    {
        return self::$_request;
    }
}
