<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event;

/**
 * This class is passed along with the events fired by Entity delete() method:
 * - BeforeDelete
 * - AfterDelete
 */
class EntityDeleteEvent extends EntityEvent
{

    private $_deletePrevented = false;
    private $_eventResult = false;

    /**
     * Set delete prevented flag
     * If true, entity delete() method will not delete the event entity
     *
     * @param bool $flag
     *
     * @return $this
     */
    public function setDeletePrevented($flag = true) {
        $this->_deletePrevented = $flag;

        return $this;
    }

    /**
     * Is delete of event entity prevented?
     * @return bool
     */
    public function getDeletePrevented() {
        return $this->_deletePrevented;
    }

    /**
     * Set event result to be returned from entity delete() method if delete is prevented
     *
     * @param mixed $data
     *
     * @return $this
     */
    public function setEventResult($data = false) {
        $this->_eventResult = $data;

        return $this;
    }

    /**
     * Get event result<br>
     * Used only if delete is prevented
     *
     * @return mixed
     */
    public function getEventResult() {
        return $this->_eventResult;
    }
}