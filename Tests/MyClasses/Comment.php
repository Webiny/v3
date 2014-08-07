<?php
namespace WebinyPlatform\Tests\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Comment extends EntityAbstract
{
	protected static $_entityCollection = "Comment";

	protected function _entityStructure() {
		// Set entity mask
		$this->_entityMask('Comment #{id}');

		// Char
		$this->attr('text')->char();

        // Many2One
		$this->attr('page')->many2one()->entity('\WebinyPlatform\Tests\MyClasses\Page');

	}
}