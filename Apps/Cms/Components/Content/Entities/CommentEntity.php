<?php
namespace WebinyPlatform\Apps\Cms\Components\Content\Entities;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class CommentEntity extends EntityAbstract
{
	protected static $_entityCollection = "Comment";
    protected static $_entityMask = 'Comment #{id}';

	protected function _entityStructure() {
		// Char
		$this->attr('text')->char();

        // Many2One
		$this->attr('page')->many2one()->setEntity('Cms.Content.PageEntity');

	}
}