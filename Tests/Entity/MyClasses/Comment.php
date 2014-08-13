<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Comment extends EntityAbstract
{
	protected static $_entityCollection = "Comment";
    protected static $_entityMask = 'Comment #{id}';

	protected function _entityStructure() {
		// Char
		$this->attr('text')->char();

        // Many2One
		$this->attr('page')->many2one()->setEntity('\WebinyPlatform\Tests\Entity\MyClasses\Page');

	}
}