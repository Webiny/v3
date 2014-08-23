<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Content\EventHandlers;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event\EntityDeleteEvent;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Event\EntityEvent;

/**
 * This class is used as a PageEntity event handler
 */
class PageEntityHandler
{
    public function beforeSave(EntityEvent $event){
        $entity = $event->getEntity();
    }

    public function afterSave(EntityEvent $event){
        $entity = $event->getEntity();
    }

    public function beforeDelete(EntityDeleteEvent $event){
        $entity = $event->getEntity();
    }

    public function afterDelete(EntityDeleteEvent $event){
        $entity = $event->getEntity();
    }

    public function extend(EntityEvent $event){
        /**
         * Add new attributes to PageEntity
         */
        $page = $event->getEntity();

        $page->attr('customAttribute')->char()->setDefaultValue('Custom attribute default value');
    }
}