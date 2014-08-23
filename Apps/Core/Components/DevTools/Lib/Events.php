<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\EventManager\Event;
use Webiny\Component\EventManager\EventManager;
use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\StdLib\StdLibTrait;

/**
 * Class that provides access to event manager.
 */
class Events
{
    use SingletonTrait, StdLibTrait;

    /**
     * @var EventManager
     */
    private $_eventManager;

    /**
     * @var array List of registered listeners.
     */
    private $_listeners = [];


    private $_registeredEventListeners = [];


    /**
     * Event manager base constructor.
     */
    protected function _init() {
        $this->_eventManager = EventManager::getInstance();
    }

    /**
     * Returns the internal array that holds all the register event listeners.
     *
     * @return array
     */
    public function getListeners() {
        return $this->_listeners;
    }

    /**
     * Sets the value of internal array holding the event listeners.
     * Do not use this function, it is use to automatically populate the events from cache.
     *
     * @param array $listeners
     */
    public function setListeners(array $listeners) {
        $this->_listeners = $listeners;
    }

    /**
     * Listen for an event and register a handler that will be triggered when the event is fired.
     *
     * @param string $event   Event name.
     * @param string $handler Handler, must be a valid callable.
     *
     * @throws \Exception
     */
    public function listen($event, $handler) {
        $this->_listeners[$event][] = $handler;
    }

    /**
     * Fire an event.
     *
     * @param string $event      Event name.
     * @param array  $eventData
     * @param null   $resultType If specified, the event results will be filtered using given class/interface name
     *
     * @return array Returns array of event results
     */
    public function fire($event, $eventData = [], $resultType = null) {
        if($this->_registerListeners($event)) {
            return $this->_eventManager->fire($event, $eventData, $resultType);
        }
    }

    /**
     * This method does on-request registration of listeners.
     * Using the on-request moment, we do not initialize the event handlers until they are really needed.
     *
     * @param string $event Name of the event for which to initialize the handlers.
     *
     * @return bool
     * @throws \Exception
     */
    private function _registerListeners($event) {
        // check if we have registered listeners for the given event
        if(!isset($this->_listeners[$event])) {
            return false;
        }

        // check if we have already registered them
        if(isset($this->_registeredEventListeners[$event])) {
            return true;
        }

        // register the listeners with the event
        foreach ($this->_listeners[$event] as $listener) {
            $listener = explode('::', $listener);
            try {
                $this->_eventManager->listen($event)->handler($listener[0])->method($listener[1]);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage() . " Event: " . $event . " handler: " . $listener[0] . " method:" . $listener[1]);
            }
        }

        // mark listeners as registered
        $this->_registeredEventListeners[$event] = true;

        // return true so we can fire the event
        return true;
    }
}