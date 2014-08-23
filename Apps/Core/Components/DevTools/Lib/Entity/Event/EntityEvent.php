<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event;

use Webiny\Component\EventManager\Event;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

/**
 * This class is passed along the following EntityAbstract events:
 *
 * - BeforeSave
 * - AfterSave
 * - Extend
 */
class EntityEvent extends Event
{

    /**
     * @var EntityAbstract
     */
    private $_entity;


    /**
     * Base constructor.
     */
    function __construct(EntityAbstract $entity) {
        $this->_entity = $entity;

        parent::__construct();
    }

    /**
     * Returns an instance of EntityAbstract
     *
     * @return EntityAbstract
     */
    public function getEntity() {
        return $this->_entity;
    }
}