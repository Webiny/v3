<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Attribute\Many2OneAttribute;


/**
 * EntityBuilder
 */

class EntityAttributeBuilder extends \Webiny\Component\Entity\EntityAttributeBuilder
{
    public function file() {
        return;
    }

    /**
     * @return Many2OneAttribute
     */
    public function many2one()
    {
        return $this->_attributes[$this->_attribute] = new Many2OneAttribute($this->_attribute, $this->_entity);
    }
}