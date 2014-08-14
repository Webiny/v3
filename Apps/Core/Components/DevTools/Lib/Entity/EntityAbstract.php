<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @link      http://www.webiny.com/wf-snv for the canonical source repository
 * @copyright Copyright (c) 2009-2013 Webiny LTD. (http://www.webiny.com)
 * @license   http://www.webiny.com/framework/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity;

/**
 * @TODO: THIS IS RELATED TO WEBINY PLATFORM
 * - create EntityExtender which is called at the end of __construct
 * - it should fire event like: entity.extend.{entity-name} and pass in $this
 * - in the event handler developers will be able to register extra attributes
 * - CRUD events will then allow developers to add new values to entities and store them to db
 */

/**
 * Entity
 * @package \WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity
 */
abstract class EntityAbstract extends \Webiny\Component\Entity\EntityAbstract
{
    public static function wInstall(){

    }

    public static function wUninstall(){

    }

    public function __construct() {
        parent::__construct();

        // @TODO: add event for registering extra attributes
    }

    public function delete() {
        /**
         * @TODO:
         * - create delete event class which will contain entity to be deleted and method to prevent deletion
         * - fire "before" and "after" event
         */
        return parent::delete();
    }

    public function save() {
        /**
         * @TODO:
         * - fire "before" and "after" event
         */
        return parent::save();
    }


    /**
     * @param $attribute
     *
     * @return EntityAttributeBuilder
     */
    public function attr($attribute) {
        return EntityAttributeBuilder::getInstance()->__setContext($this->_attributes, $attribute)->__setEntity($this);
    }
}