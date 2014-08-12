<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Page extends EntityAbstract
{
	protected static $_entityCollection = "Page";
	protected static $_entityMask = '{title} ({id})';

	protected function _entityStructure() {
		// Char
		$this->attr('title')->char();

        // One2Many
		$this->attr('comments')->one2many('page')->entity('\WebinyPlatform\Tests\Entity\MyClasses\Comment')->onDelete();

        // Many2Many
        $this->attr('labels')->many2many('Label2Page')->entity('\Webiny\Component\Entity\Tests\Classes\Label');
	}
}