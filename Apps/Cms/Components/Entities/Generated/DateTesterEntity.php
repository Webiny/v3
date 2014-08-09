<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Entities\Generated;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class DateTesterEntity extends EntityAbstract {

    protected static $_entityCollection = 'DateTester';

    protected static $_entityMask = 'DateTester #{id}';

    /**
    * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
    */
    public function getUnix(){
        return $this->getAttribute('unix');
    }

    /**
    * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
    */
    public function getDatetime(){
        return $this->getAttribute('datetime');
    }

    /**
    * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
    */
    public function getDate(){
        return $this->getAttribute('date');
    }

    /**
    * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
    */
    public function getTime(){
        return $this->getAttribute('time');
    }

    
	protected function _entityStructure() {
        $this->attr('unix')->datetime()->format('unix')->defaultValue('now')->required(true);
        $this->attr('datetime')->datetime()->format('datetime')->defaultValue('now')->required(true);
        $this->attr('date')->datetime()->format('date')->defaultValue('now')->required(true);
        $this->attr('time')->datetime()->format('time')->defaultValue('now')->required(true);
        }
}