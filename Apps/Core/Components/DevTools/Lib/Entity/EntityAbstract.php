<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity;

use Webiny\Component\Entity\Attribute\BooleanAttribute;
use Webiny\Component\Entity\Attribute\DateTimeAttribute;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event\EntityDeleteEvent;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event\EntityEvent;

/**
 * EntityAbstract class is the main class to extend when creating your own entities
 */
abstract class EntityAbstract extends \Webiny\Component\Entity\EntityAbstract
{
    use DevToolsTrait;

    private static $_protectedAttributes = [
        'id',
        'createdOn',
        'modifiedOn',
        'deletedOn',
        'deleted'
    ];

    final public static function wInstall() {

    }

    final public static function wUninstall() {

    }

    /**
     * Remove given $fields from all instances of this entity
     *
     * @param array $fields
     */
    final public static function wRemoveFields($fields = []) {
        /**
         * Unset protected attributes
         */
        $fields = array_diff($fields, self::$_protectedAttributes);
        self::_wDatabase()->update(static::$_entityCollection, [], ['$unset' => array_flip($fields)], ['multiple' => true]);
    }

    /**
     * Get createdOn attribute
     * @return DateTimeAttribute
     */
    public function getCreatedOn() {
        return $this->getAttribute('createdOn');
    }

    /**
     * Get modifiedOn attribute
     * @return DateTimeAttribute
     */
    public function getModifiedOn() {
        return $this->getAttribute('modifiedOn');
    }

    /**
     * Get deletedOn attribute
     * @return DateTimeAttribute
     */
    public function getDeletedOn() {
        return $this->getAttribute('deletedOn');
    }

    /**
     * Get deleted attribute
     * @return BooleanAttribute
     */
    public function getDeleted() {
        return $this->getAttribute('deleted');
    }

    public function __construct() {
        parent::__construct();
        /**
         * Add the following built-in system attributes:
         * createdOn, modifiedOn, deletedOn, deleted and user
         */
        $this->attr('createdOn')->datetime()->setDefaultValue('now');
        $this->attr('modifiedOn')->datetime()->setDefaultValue('now')->setAutoUpdate(true);
        $this->attr('deletedOn')->datetime();
        $this->attr('deleted')->boolean()->setDefaultValue(false);

        /**
         * Fire event for registering extra attributes
         */
        $this->_wEvents()->fire($this->_getEventName() . '.Extend', new EntityEvent($this));

    }

    public function delete() {
        $this->getDeleted()->setValue(true);
        $this->getDeletedOn()->setValue('now');

        $event = new EntityDeleteEvent($this);
        $this->_wEvents()->fire($this->_getEventName() . '.BeforeDelete', $event);

        /**
         * If delete was prevented in some event handler, return event result (false by default)
         */
        if($event->getDeletePrevented()) {
            return $event->getEventResult();
        }

        $deleted = parent::delete();

        if($deleted) {
            $this->_wEvents()->fire($this->_getEventName() . '.AfterDelete', $event);
        }

        return $deleted;
    }

    public function save() {
        $event = new EntityEvent($this);
        $this->_wEvents()->fire($this->_getEventName() . '.BeforeSave', $event);
        $save = parent::save();
        $this->_wEvents()->fire($this->_getEventName() . '.AfterSave', $event);

        return $save;
    }


    /**
     * @param $attribute
     *
     * @return EntityAttributeBuilder
     */
    public function attr($attribute) {
        return EntityAttributeBuilder::getInstance()->__setContext($this->_attributes, $attribute)->__setEntity($this);
    }

    public function archive() {

    }

    private function _getEventName() {
        $classParts = $this->str(get_class($this))->explode('\\');
        $eventName = $classParts[2] . '.' . $classParts[6];

        return $eventName;

    }
}