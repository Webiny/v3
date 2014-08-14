<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Entities\Generated;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class DateTesterEntity extends EntityAbstract
{

    protected static $_entityCollection = 'DateTester';

    protected static $_entityMask = 'DateTester #{id}';

    /**
     * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
     */
    public function getDatetime() {
        return $this->getAttribute('datetime');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
     */
    public function getModified() {
        return $this->getAttribute('modified');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\DateAttribute
     */
    public function getDate() {
        return $this->getAttribute('date');
    }

	protected function _entityStructure() {
        $this->attr('datetime')->datetime()->setAutoUpdate(false)->setDefaultValue('now');
        $this->attr('modified')->datetime()->setAutoUpdate(true)->setDefaultValue('now');
        $this->attr('date')->date()->setAutoUpdate(true)->setDefaultValue('');
    }
}