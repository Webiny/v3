<?php
namespace WebinyPlatform\Tests\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Page extends EntityAbstract
{
	protected static $_entityCollection = "Page";

	protected function _entityStructure() {
		// Set entity mask
		$this->_entityMask('{title} ({id})');

		// Char
		$this->attr('title')->char();

        // One2Many
		$this->attr('comments')->one2many('page')->entity('\WebinyPlatform\Tests\MyClasses\Comment')->onDelete();
	}
}