<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity;

/**
 * Entity component main class
 * Use this class to configure Entity component.
 */
class Entity extends \Webiny\Component\Entity\Entity
{
    /**
     * Get entity database
     * @return Mongo
     */
    public function getDatabase() {
        /**
         * @TODO:
         * - na koji nacin ce se ovdje uklopiti Database klasa koju si napravio u DevTools?
         * - ja ovdje koristim direktno MongoTrait iz frameworka - kako si zamislio konfiguriranje te Database klase?
         */
        if(self::$_database == null) {
            self::$_database = self::mongo(self::getConfig()->Database);
        }

        return self::$_database;
    }
}