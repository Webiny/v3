<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\EventManager\EventManager;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * Class that provides access to event manager.
 */
class Events
{
    use SingletonTrait;

    /**
     * @var EventManager
     */
    private $_eventManager;

    protected function _init()
    {
        $this->_eventManager = EventManager::getInstance();
    }

    public function listen($event, $handler)
    {
        $this->_eventManager->listen($event)->handler($handler);
    }

    public function fire($event)
    {
        $this->_eventManager->fire($event);
    }
}